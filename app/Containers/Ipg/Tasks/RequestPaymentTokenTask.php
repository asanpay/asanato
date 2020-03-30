<?php


namespace App\Containers\Ipg\Tasks;


use App\Containers\Ipg\Enum\RequestTokenErrors;
use App\Containers\Merchant\Models\Merchant;
use App\Containers\Transaction\Models\Transaction;
use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Facades\Validator;
use App\Ship\Parents\Tasks\Task;

class RequestPaymentTokenTask extends Task
{
    protected Merchant    $merchant;
    protected Transaction $transaction;

    public function __construct(Merchant $merchant, Transaction $transaction)
    {
        $this->merchant    = $merchant;
        $this->transaction = $transaction;
    }

    public function run(Request $request): array
    {
        try {
            $parameters = $request->all();

            // amount --------------------------------------------------------------------------------------------------
            $minimumPayableAmount = config('finance.limit.psp.min');
            $validator            = Validator::make($parameters, [
                'amount' => "required|integer|min:{$minimumPayableAmount}",
            ]);

            if ($validator->fails()) {
                return [
                    null,
                    [
                        'code'  => RequestTokenErrors::INVALID_AMOUNT,
                        'error' => $validator->errors()->first(),
                    ],
                ];
            }

            // callback ------------------------------------------------------------------------------------------------
            $validator = Validator::make($parameters, [
                'callback_url' => 'required|string|url',
            ]);

            if ($validator->fails()) {
                return [
                    null,
                    [
                        'code'  => RequestTokenErrors::INVALID_CALLBACK_URL,
                        'error' => $validator->errors()->first(),
                    ],
                ];
            }

            // invoice_id ----------------------------------------------------------------------------------------------
            $validator = Validator::make($parameters, [
                'invoice_id' => "nullable|string|max:32",
            ]);

            if ($validator->fails()) {
                return [
                    null,
                    [
                        'code'  => RequestTokenErrors::INVALID_INVOICE_ID,
                        'error' => $validator->errors()->first(),
                    ],
                ];
            }

            // payer name ----------------------------------------------------------------------------------------------
            $validator = Validator::make($parameters, [
                'name' => 'nullable|string|max:32',
            ]);

            if ($validator->fails()) {
                return [
                    null,
                    [
                        'code'  => RequestTokenErrors::INVALID_NAME,
                        'error' => $validator->errors()->first(),
                    ],
                ];
            }

            // payer mobile --------------------------------------------------------------------------------------------
            $validator = Validator::make($parameters, [
                'mobile' => 'nullable|regex:/' . config('regex.mobile_regex') . '/',
            ]);

            if ($validator->fails()) {
                return [
                    null,
                    [
                        'code'  => RequestTokenErrors::INVALID_MOBILE,
                        'error' => $validator->errors()->first(),
                    ],
                ];
            }

            // payer email ---------------------------------------------------------------------------------------------
            $validator = Validator::make($parameters, [
                'email' => 'nullable|email|max:40',
            ]);

            if ($validator->fails()) {
                return [
                    null,
                    [
                        'code'  => RequestTokenErrors::INVALID_EMAIL,
                        'error' => $validator->errors()->first(),
                    ],
                ];
            }

            // description ---------------------------------------------------------------------------------------------
            $validator = Validator::make($parameters, [
                'description' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return [
                    null,
                    [
                        'code'  => RequestTokenErrors::INVALID_DESCRIPTION,
                        'error' => $validator->errors()->first(),
                    ],
                ];
            }

            // refund ---------------------------------------------------------------------------------------------
            $validator = Validator::make($parameters, [
                'refund' => 'nullable|integer|in:0,1',
            ]);

            if ($validator->fails()) {
                return [
                    null,
                    [
                        'code'  => RequestTokenErrors::INVALID_REFUND,
                        'error' => $validator->errors()->first(),
                    ],
                ];
            }

            // direct ---------------------------------------------------------------------------------------------
            $validator = Validator::make($parameters, [
                'direct' => 'nullable|integer|in:0,1',
            ]);

            if ($validator->fails()) {
                return [
                    null,
                    [
                        'code'  => RequestTokenErrors::INVALID_DIRECT,
                        'error' => $validator->errors()->first(),
                    ],
                ];
            }

            // merchant ------------------------------------------------------------------------------------------------
            $validator = Validator::make($request->all(), [
                'merchant' => 'required|alpha_num|size:64|exists:merchants,api_key',
            ]);

            if ($validator->fails()) {
                return [
                    null,
                    [
                        'code'  => RequestTokenErrors::MERCHANT_NOT_FOUND,
                        'error' => $validator->errors()->first(),
                    ],
                ];
            }

            $m = $this->merchant->findByApiKey($request->input('merchant'));

            // check if merchant is active or not
            if ($m->status != true) {
                return [
                    null,
                    [
                        'code'  => RequestTokenErrors::DISABLED_MERCHANT,
                        'error' => 'merchant is not active',
                    ],
                ];
            }

            // check ip address of token request
            if (!empty($m->ip_access)) {
                $ipAddresses = explode(',', $m->ip_access);

                if (!in_array($request->ip(), $ipAddresses)) {
                    return [
                        null,
                        [
                            'code'  => RequestTokenErrors::UNAUTHORIZED_IP_ADDRESS,
                            'error' => "unauthorized ip address {$request->ip()}",
                        ],
                    ];
                }
            }

            // check domain of callback URL
            $parsedCallbackUrl = parse_url($request->input('callback_url'));

            if ($parsedCallbackUrl['host'] != $m->domain) {
                return [
                    null,
                    [
                        'code'  => RequestTokenErrors::INVALID_CALLBACK_URL,
                        'error' => 'given callback url is not match with merchant domain',
                    ],
                ];
            }

            $calculatedAmounts = $m->calculatePayable($request->input('amount'));

            if ($calculatedAmounts->payable_amount < $minimumPayableAmount) {
                return [
                    null,
                    [
                        'code'  => RequestTokenErrors::LOWER_AMOUNT_AFTER_WAGE,
                        'error' => $validator->errors()->first(),
                    ],
                ];
            } elseif ($request->input('direct') == true && ($calculatedAmounts->payable_amount > config('finance.limit.psp.max'))) {
                return [
                    null,
                    [
                        'code'  => RequestTokenErrors::HIGHER_AMOUNT_AFTER_WAGE,
                        'error' => $validator->errors()->first(),
                    ],
                ];
            }

            $t                 = new $this->transactions;
            $t->user_id        = $m->user_id;
            $t->merchant_id    = $m->id;
            $t->amount         = $request->input('amount');
            $t->payable_amount = $calculatedAmounts->payable_amount;
            $t->merchant_share = $calculatedAmounts->merchant_share;
            $t->callback_url   = $request->input('callback_url');
            $t->invoice_number = trim($request->input('invoice_id'));
            $t->description    = trim($request->input('description'));
            $t->payer_name     = trim($request->input('name'));
            $t->payer_email    = trim(strtolower($request->input('email')));
            $t->payer_mobile   = trim($request->input('mobile'));

            // extra
            $t->addToJsonb('direct', boolval($request->input('direct', true)), false);
            $t->addToJsonb('refund', boolval($request->input('refund', false)), false);

            // wage policy at specific time
            $t->addToJsonb('wage', [
                'policy' => $m->wage_policy,
                'value'  => $m->wage_value,
                'by'     => $m->wage_by,
            ], false);

            $t->save();

            return [
                [
                    'code'        => 0,
                    'token'       => $t->token,
                    'date'        => $t->created_at->toDateTimeString(),
                    'jalali_date' => $t->j_created_at,
                ],
                null,
            ];

        } catch (Exception $e) {
            return [
                null,
                [
                    'code'  => RequestTokenErrors::UNKNOWN_ERROR,
                    'error' => config('app.debug') ? $e->getTraceAsString() : __('Internal server error! please try again'),
                ],
            ];
        }
    }
}
