<?php


namespace App\Containers\Ipg\Actions;

use App\Containers\Ipg\Enum\RequestTokenErrors;
use App\Containers\Ipg\UI\API\Requests\IpgRequestTokenRequest;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

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

            // payer name ----------------------------------------------------------------------------------------------
            $validator = Validator::make($parameters, [
                'name' => 'nullable|string|max:32',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'code'       => RequestTokenErrors::INVALID_NAME,
                    'error'      => $validator->errors()->first(),
                    'x_track_id' => resolve('xTrackId'),
                ], 422);
            }

            // payer mobile --------------------------------------------------------------------------------------------
            $validator = Validator::make($parameters, [
                'mobile' => 'nullable|regex:' . config('regex.mobile_regex'),
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'code'       => RequestTokenErrors::INVALID_MOBILE,
                    'error'      => $validator->errors()->first(),
                    'x_track_id' => resolve('xTrackId'),
                ], 422);
            }

            // payer email ---------------------------------------------------------------------------------------------
            $validator = Validator::make($parameters, [
                'email' => 'nullable|email|max:40',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'code'       => RequestTokenErrors::INVALID_EMAIL,
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

            // merchant ------------------------------------------------------------------------------------------------
            $validator = Validator::make($request->all(), [
                'merchant' => 'required|alpha_num|size:64|exists:merchants,api_key',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'code'       => RequestTokenErrors::MERCHANT_NOT_FOUND,
                    'error'      => $validator->errors()->first(),
                    'x_track_id' => resolve('xTrackId'),
                ], 422);
            }

            $m = Apiato::call('Merchant@FindMerchantByApiKeyTask', [$request->input('merchant')]);

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
                        'error'      => "unauthorized ip address {$request->ip()}",
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

            $calculatedAmounts = $m->calculatePayable($request->input('amount'));

            if ($calculatedAmounts->payable_amount < $minimumPayableAmount) {
                return response()->json([
                    'code'       => RequestTokenErrors::LOWER_AMOUNT_AFTER_WAGE,
                    'error'      => $validator->errors()->first(),
                    'x_track_id' => resolve('xTrackId'),
                ], 422);
            } elseif ($request->input('direct') == true && ($calculatedAmounts->payable_amount > config('finance.limit.psp.max'))) {
                return response()->json([
                    'code'       => RequestTokenErrors::HIGHER_AMOUNT_AFTER_WAGE,
                    'error'      => $validator->errors()->first(),
                    'x_track_id' => resolve('xTrackId'),
                ], 422);
            }

            $data  = [
                'user_id'        => $m->user_id,
                'merchant_id'    => $m->id,
                'amount'         => $request->input('amount'),
                'payable_amount' => $calculatedAmounts->payable_amount,
                'merchant_share' => $calculatedAmounts->merchant_share,
                'callback_url'   => $request->input('callback_url'),
                'invoice_number' => trim($request->input('invoice_id')),
                'description'    => trim($request->input('description')),
                'payer_name'     => trim($request->input('name')),
                'payer_email'    => trim(strtolower($request->input('email'))),
                'payer_mobile'   => trim($request->input('mobile')),
            ];
            $jsonb = [
                // extra
                'direct' => boolval($request->input('direct', true)),
                'refund' => boolval($request->input('direct', true)),
                // wage policy at specific time
                'wage'   => [
                    'policy' => $m->wage_policy,
                    'value'  => $m->wage_value,
                    'by'     => $m->wage_by,
                ],
            ];

            $t = Apiato::call('Transaction@CreateTransactionTask', [$data, $jsonb]);

            return response()->json([
                'code'        => 0,
                'token'       => $t->token,
                'date'        => $t->created_at->toDateTimeString(),
                'jalali_date' => $t->j_created_at,
                'x_track_id'  => resolve('xTrackId'),
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
