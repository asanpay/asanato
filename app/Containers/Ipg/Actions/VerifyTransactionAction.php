<?php


namespace App\Containers\Ipg\Actions;

use App\Containers\Ipg\Enum\VerifyRequestErrors;
use App\Containers\Ipg\UI\API\Requests\IpgVerifyTransactionRequest;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Tartan\Log\Facades\XLog;
use App\Exception;

class VerifyTransactionAction extends Action
{
    public function run(IpgVerifyTransactionRequest $request): JsonResponse
    {
        try {
            $parameters = $request->all();

            // token ---------------------------------------------------------------------------------------------------
            $validator = Validator::make($parameters, [
                'token' => 'required|alpha_dash|regex:' . config('regex.token_regex'),
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'code'       => VerifyRequestErrors::INVALID_TOKEN,
                    'error'      => $validator->errors()->first(),
                    'x_track_id' => resolve('xTrackId'),
                ], 422);
            }

            // merchant ------------------------------------------------------------------------------------------------
            $validator = Validator::make($request->all(), [
                'merchant' => 'required|alpha_num|size:64|exists:merchants,code',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'code'   => VerifyRequestErrors::MERCHANT_NOT_FOUND,
                    'errors' => $validator->errors(),
                ], 422);
            }

            $m = Apiato::call('Merchant@FindMerchantByCodeTask', [$request->input('merchant')]);

            // check if merchant is active or not
            if ($m->status != true) {
                return response()->json([
                    'code'   => VerifyRequestErrors::DISABLED_MERCHANT,
                    'errors' => 'merchant is not active',
                ], 422);
            }

            // load the transaction
            $t = Apiato::call('Transaction@FindTransactionByPublicTokenTask', [$request->input('token')]);

            if (empty($t)) {
                return response()->json([
                    'code'   => VerifyRequestErrors::TRANSACTION_NOT_FOUND,
                    'errors' => 'merchant is not active',
                ], 422);
            }

            // check if transaction belongs to the selected merchant or not
            if ($t->merchant_id != $m->id) {
                return response()->json([
                    'code'   => VerifyRequestErrors::TRANSACTION_NOT_FOUND,
                    'errors' => 'the transaction does not belong to the merchant',
                ], 422);
            }

            // if refund is possible
            if ($t->isRefundable()) {
                $refundPatch = ['refund_token' => $t->getFromJsonb('refund_token')];
            } else {
                $refundPatch = [];
            }

            if ($t->isAccomplished()) {
                // transaction has accomplished before
                return response()->json(array_merge([
                    'code'       => VerifyRequestErrors::OK,
                    'date'       => $t->j_accomplished_at,
                    'token'      => $t->token,
                    'x_track_id' => resolve('xTrackId'),
                ], $refundPatch));
            } elseif ($t->isReadyAccomplish()) {
                // check if transaction is ready for accomplishment or not
                if ($t->setAccomplished()) {
                    // transaction marked as accomplished
                    return response()->json(array_merge([
                        'code'       => VerifyRequestErrors::OK,
                        'date'       => $t->j_accomplished_at,
                        'token'      => $t->token,
                        'x_track_id' => resolve('xTrackId'),
                    ], $refundPatch));
                } else {
                    throw new Exception('Could not accomplish transaction');
                }
            } else {
                // transaction is not accomplished and also could not be accomplished successfully
                return response()->json([
                    'code'       => VerifyRequestErrors::NOT_ACCOMPLISH_READY,
                    'error'      => __('Could not accomplish transaction'),
                    'x_track_id' => resolve('xTrackId'),
                ]);
            }
        } catch (Exception $e) {
            XLog::exception($e);

            return response()->json([
                'code'       => VerifyRequestErrors::UNKNOWN_ERROR,
                'error'      => $this->weAreOnApiDebug() ? $e->getMessage() : __('Internal server error! please try again'),
                'x_track_id' => resolve('xTrackId'),
            ], 500);
        }
    }
}
