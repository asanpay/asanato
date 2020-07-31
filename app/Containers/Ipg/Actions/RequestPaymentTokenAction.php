<?php
declare(strict_types = 1);

namespace App\Containers\Ipg\Actions;

use App\Containers\Ipg\Enum\RequestTokenErrors;
use App\Containers\Ipg\UI\API\Requests\IpgRequestTokenRequest;
use App\Containers\Transaction\Enum\TransactionType;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Exception;

class RequestPaymentTokenAction extends Action
{
    public function run(IpgRequestTokenRequest $request): JsonResponse
    {
        try {
            $parameters = $request->all();

            // amount --------------------------------------------------------------------------------------------------
            $minimumPayableAmount = config('finance.limit.psp.min');
            $validator            = Validator::make($parameters, [
                'amount' => "required|integer|min:{$minimumPayableAmount}",
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'code'       => RequestTokenErrors::INVALID_AMOUNT,
                    'error'      => $validator->errors()->first(),
                    'x_track_id' => resolve('xTrackId'),
                ], 422);
            }

            // callback ------------------------------------------------------------------------------------------------
            $validator = Validator::make($parameters, [
                'callback_url' => 'required|string|url',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'code'       => RequestTokenErrors::INVALID_CALLBACK_URL,
                    'error'      => $validator->errors()->first(),
                    'x_track_id' => resolve('xTrackId'),
                ], 422);
            }

            // invoice_id ----------------------------------------------------------------------------------------------
            $validator = Validator::make($parameters, [
                'invoice_id' => "nullable|string|max:32",
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'code'       => RequestTokenErrors::INVALID_INVOICE_ID,
                    'error'      => $validator->errors()->first(),
                    'x_track_id' => resolve('xTrackId'),
                ], 422);
            }

            // description ---------------------------------------------------------------------------------------------
            $validator = Validator::make($parameters, [
                'description' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'code'       => RequestTokenErrors::INVALID_DESCRIPTION,
                    'error'      => $validator->errors()->first(),
                    'x_track_id' => resolve('xTrackId'),
                ], 422);
            }

            // refund ---------------------------------------------------------------------------------------------
            $validator = Validator::make($parameters, [
                'refund' => 'nullable|integer|in:0,1',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'code'       => RequestTokenErrors::INVALID_REFUND,
                    'error'      => $validator->errors()->first(),
                    'x_track_id' => resolve('xTrackId'),
                ], 422);
            }

            // direct ---------------------------------------------------------------------------------------------
            $validator = Validator::make($parameters, [
                'direct' => 'nullable|integer|in:0,1',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'code'       => RequestTokenErrors::INVALID_DIRECT,
                    'error'      => $validator->errors()->first(),
                    'x_track_id' => resolve('xTrackId'),
                ], 422);
            }

            // payer data ----------------------------------------------------------------------------------------------
            $validator = Validator::make($request->all(), [
                'name'   => 'nullable|string|max:32',
                'email'  => 'nullable|email|string|max:40',
                'mobile' => 'nullable|regex:' . config('regex.mobile_regex'),
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'code'       => RequestTokenErrors::INVALID_PAYER_DATA,
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
                    'code'       => RequestTokenErrors::MERCHANT_NOT_FOUND,
                    'error'      => $validator->errors()->first(),
                    'x_track_id' => resolve('xTrackId'),
                ], 422);
            }

            $m = Apiato::call('Merchant@FindMerchantByCodeTask', [$request->input('merchant')]);

            // check if merchant is active or not
            if ($m->status != true) {
                return response()->json([
                    'code'       => RequestTokenErrors::DISABLED_MERCHANT,
                    'error'      => 'merchant is not active',
                    'x_track_id' => resolve('xTrackId'),
                ], 422);
            }

            // check ip address of token request
            if (!empty($m->ip_access)) {
                $ipAddresses = explode(',', $m->ip_access);

                if (!in_array($request->ip(), $ipAddresses)) {
                    return response()->json([
                        'code'       => RequestTokenErrors::UNAUTHORIZED_IP_ADDRESS,
                        'error'      => "{$request->ip()} ip address is unauthorized",
                        'x_track_id' => resolve('xTrackId'),
                    ], 422);
                }
            }

            // check domain of callback URL
            $parsedCallbackUrl = parse_url($request->input('callback_url'));

            if ($parsedCallbackUrl['host'] != $m->domain) {
                return response()->json([
                    'code'       => RequestTokenErrors::INVALID_CALLBACK_URL,
                    'error'      => 'given callback url is not match with merchant domain',
                    'x_track_id' => resolve('xTrackId'),
                ], 422);
            }

            $calculatedAmounts = $m->calculatePayable(intval($request->input('amount')));

            // check amount validity
            if ($calculatedAmounts->payable_amount < $minimumPayableAmount) {
                return response()->json([
                    'code'       => RequestTokenErrors::LOWER_AMOUNT_AFTER_FEE,
                    'error'      => $validator->errors()->first(),
                    'x_track_id' => resolve('xTrackId'),
                ], 422);
            } elseif ($request->input('direct') == true && ($calculatedAmounts->payable_amount > config('finance.limit.psp.max'))) {
                return response()->json([
                    'code'       => RequestTokenErrors::HIGHER_AMOUNT_AFTER_FEE,
                    'error'      => $validator->errors()->first(),
                    'x_track_id' => resolve('xTrackId'),
                ], 422);
            }

            // multiplex handling --------------------------------------------------------------------------------------
            if ($request->filled('multiplex')) {
                // parse and validate multiplex data
                try {
                    $multiplexParseResult = Apiato::call('Ipg@MultiplexDataParserTask', [
                        $request->all(),
                        $m
                    ]);
                } catch (\App\Exception $e) {
                    return response()->json([
                        'code'       => $e->getCode(),
                        'error'      => $e->getMessage(),
                        'x_track_id' => resolve('xTrackId'),
                    ], 422);
                }

                // check user access to all requested wallets
                $userHasAccess = Apiato::call('User@CheckUserHasAccessToWalletsTask',
                    [$m->user->id, $multiplexParseResult['wallets']]);
                if ($userHasAccess !== true) {
                    return response()->json([
                        'code'       => RequestTokenErrors::INVALID_MULTIPLEX_DATA,
                        'error'      => 'you dont have access to all passed multiplex wallets',
                        'x_track_id' => resolve('xTrackId'),
                    ], 401);
                }
            }

            $data = [
                'type'           => TransactionType::MERCHANT,
                'user_id'        => $m->user_id,
                'merchant_id'    => $m->id,
                'amount'         => $request->input('amount'),
                'payable_amount' => $calculatedAmounts->payable_amount,
                'merchant_share' => $calculatedAmounts->merchant_share,
                'callback_url'   => $request->input('callback_url'),
                'invoice_number' => $request->input('invoice_id'),
                'payer'          => array_filter([
                    'name'   => $request->input('name'),
                    'email'  => emailify($request->input('email')),
                    'mobile' => mobilify($request->input('mobile')),
                ]),
                'ip_address'     => $request->getClientIp(),
                'multiplex'      => json_decode($request->input('multiplex', '{}')),
            ];

            $data ['meta'] = [
                'description' => $request->input('description'),
                // extra
                'direct'      => boolval($request->input('direct', false)),
                'refund'      => boolval($request->input('refund', false)),
                // fee policy at specific time
                'fee'        => [
                    'policy' => $m->fee_policy,
                    'value'  => $m->fee_value,
                    'by'     => $m->fee_by,
                ],
            ];

            $t = Apiato::call('Transaction@CreateTransactionTask', [$data]);

            return response()->json([
                'code'        => 0,
                'token'       => $t->token,
                'date'        => $t->created_at,
                'jalali_date' => $t->j_created_at,
                'x_track_id'  => resolve('xTrackId'),
                'gate_url'    => route('web_ipg_gateway', ['token' => $t->token]),
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'code'       => RequestTokenErrors::UNKNOWN_ERROR,
                'error'      => $this->weAreOnApiDebug() ? $e->getTraceAsString() : __('Internal server error! please try again'),
                'x_track_id' => resolve('xTrackId'),
            ], 500);
        }
    }
}
