<?php

namespace App\Containers\Ipg\Actions;

use App\Containers\Ipg\UI\WEB\Requests\IpgTransactionCallbackRequest;
use App\Containers\Transaction\Enum\TransactionStatus;
use App\Containers\Transaction\Models\Transaction;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use Asanpay\Shaparak\Facades\Shaparak;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Tartan\Log\Facades\XLog;
use App\Exception;

class TransactionCallbackAction extends Action
{
    public function run(string $token, IpgTransactionCallbackRequest $request)
    {
        XLog::info('TransactionCallbackAction');

        $paidSuccessfully = false;
        $accomplished     = [];

        do {
            try {
                $validator = Validator::make(
                    [
                        'token' => $token,
                    ],
                    [
                        'token' => [
                            'required',
                            'alpha_dash',
                            'regex:' . config('regex.token_regex'),
                        ],
                    ]
                );

                // validate required route parameters
                if ($validator->fails()) {
                    XLog::debug('TransactionCallbackAction::run', ['error' => $validator->errors()->first()]);

                    return view('ipg::callback')->withErrors([__('ipg.callback_err.tr_not_found_cod1')]);
                }

                // find the transaction by token
                $transaction = Apiato::call('Transaction@FindTransactionByPublicTokenTask', [$token]);

                // transaction not found
                if (!$transaction) {
                    XLog::debug('TransactionCallbackAction::run', ['error' => 'transaction not found']);

                    return view('ipg::callback')->withErrors([__('ipg.callback_err.tr_not_found_cod2')]);
                }

                // get PSP that transaction paid by
                $psp     = $transaction->psp->slug;
                $gateway = $transaction->gateway_id;

                // patch `shaparak mode` into gateway properties that fetched from gateway row
                $gatewayProperties = $transaction->gateway->getRealtimeProperties();

                // init Shaparak
                $shaparak = Shaparak::with($psp, $transaction, $gatewayProperties)
                    ->setParameters($request->all());

                // according to the psp gateway`s callback parameter,
                // Is it possible to continue with transaction or not?
                if ($shaparak->canContinueWithCallbackParameters() !== true) {
                    Session::flash('alert-danger', __('ipg.could_not_continue_because_of_callback_params'));
                    break;
                }

                // transaction never touched callback process
                if ($transaction->status <= TransactionStatus::CALLBACK) {
                    // extract PSP gateway`s reference Id from the posted callback parameters
                    $referenceId = $shaparak->getGatewayReferenceId();

                    // check for double-spending transaction
                    $doubleSpending = Apiato::call(
                        'Transaction@TransactionHasDoubleSpendingTask',
                        [$transaction, $referenceId, $request]
                    );

                    // if double-spending transaction found
                    if ($doubleSpending === true) {
                        Session::flash('alert-danger', trans('ipg.double_spending'));
                        break;
                    }

                    // update transaction`s callback parameter
                    $transaction->setCallBackParameters($request->all());
                }

                // start to verify the transaction ---------------------------------------------------------------------
                if ($transaction->status < TransactionStatus::VERIFIED) {
                    $verified = false;

                    for ($i = 1; $i <= 3; $i++) {
                        try {
                            XLog::info(
                                'trying to verify payment',
                                [
                                    'try'  => $i,
                                    'ref'  => $referenceId,
                                    'gate' => $gateway,
                                    'psp'  => $psp,
                                    $transaction->tagify(),
                                ]
                            );

                            $verifyResult = $shaparak->verifyTransaction();

                            if ($verifyResult === true) {
                                $verified = true;
                            }
                            XLog::info(
                                'verify result',
                                [
                                    'try'    => $i,
                                    'ref'    => $referenceId,
                                    'gate'   => $gateway,
                                    'psp'    => $psp,
                                    'result' => $verifyResult,
                                    $transaction->tagify(),
                                ]
                            );
                            break;
                        } catch (Exception $e) {
                            XLog::error(
                                'Exception: ' . $e->getMessage(),
                                [
                                    'try'    => $i,
                                    'ref'    => $referenceId,
                                    'gate'   => $gateway,
                                    'psp'    => $psp,
                                    'result' => $verifyResult ?? '',
                                    $transaction->tagify(),
                                ]
                            );
                            continue;
                        }
                    }

                    if ($verified !== true) {
                        XLog::error(
                            'transaction verification failed',
                            ['ref' => $referenceId, 'gate' => $gateway, 'psp' => $psp, $transaction->tagify()]
                        );
                        break;
                    } else {
                        XLog::info(
                            'invoice verified successfully',
                            ['ref' => $referenceId, 'gate' => $gateway, 'psp' => $psp, $transaction->tagify()]
                        );
                    }
                }
                // verify end ------------------------------------------------------------------------------------------
                XLog::info("transaction status is $transaction->status after verification", [$transaction->tagify()]);

                // settle start ----------------------------------------------------------------------------------
                if ($transaction->status < TransactionStatus::SETTLED) {
                    $afterVerified = false;
                    for ($i = 1; $i <= 3; $i++) {
                        try {
                            XLog::info(
                                'trying to settle payment',
                                [
                                    'try'  => $i,
                                    'ref'  => $referenceId,
                                    'gate' => $gateway,
                                    'psp'  => $psp,
                                    $transaction->tagify(),
                                ]
                            );

                            $settleResult = $shaparak->settleTransaction();
                            if ($settleResult) {
                                $afterVerified = true;
                            }
                            XLog::info(
                                'settle result',
                                [
                                    'try'    => $i,
                                    'ref'    => $referenceId,
                                    'gate'   => $gateway,
                                    'psp'    => $psp,
                                    'result' => $verifyResult,
                                    $transaction->tagify(),
                                ]
                            );
                            break;
                        } catch (\Exception $e) {
                            XLog::error(
                                'Exception: ' . $e->getMessage(),
                                [
                                    'try'    => $i,
                                    'ref'    => $referenceId,
                                    'gate'   => $gateway,
                                    'psp'    => $psp,
                                    'result' => $verifyResult ?? '',
                                    $transaction->tagify(),
                                ]
                            );
                            continue;
                        }
                    }

                    if ($afterVerified !== true) {
                        XLog::error(
                            'transaction settlement failed',
                            ['ref' => $referenceId, 'gate' => $gateway, 'psp' => $psp, $transaction->tagify()]
                        );
                        break;
                    } else {
                        XLog::info(
                            'invoice settled successfully',
                            ['ref' => $referenceId, 'gate' => $gateway, 'psp' => $psp, $transaction->tagify()]
                        );
                    }
                }
                // settle end ------------------------------------------------------------------------------------
                XLog::info("transaction status is $transaction->status after settlement", [$transaction->tagify()]);

                // if transaction has been accomplished before
                if ($transaction->status >= TransactionStatus::ACCOMPLISHED) {
                    XLog::info("transaction has been processed before", [$transaction->tagify()]);
                    $paidSuccessfully = true;
                    $accomplished     = ['accomplished' => 1]; // add flag to callback parameters
                    // no further process required
                    break;
                }

                /*
                * ** process transactions that should be processed in this level and does not require verification **
                *
                * for example wallet top-up transaction does not require verification
                * from any 3rd party service like Merchant website and should be process immediately
                */
                XLog::debug("trying to process transaction", [$transaction->tagify()]);
                Apiato::call('Ipg@ProcessAccomplishedPspTransactionSubAction', [$transaction]);

                $paidSuccessfully = true;
            } catch (Exception $e) {
                $tags = [];
                if (isset($transaction) && $transaction instanceof Transaction) {
                    $tags[] = $transaction->tagify();
                }
                XLog::emergency(
                    $e->getMessage() . ' code:' . $e->getCode() . ' ' . $e->getFile() . ':' . $e->getLine(),
                    $tags
                );
                break;
            }
        } while (false); // do not repeat

        $merchantCallbackUrl = $transaction->callback_url . '?' .
            http_build_query(
                array_merge(
                    [
                        'status'      => ($paidSuccessfully ? 1 : 0),
                        'token'       => $token,
                        'tracking_id' => $transaction->tracking_id,
                        'x_track_id'  => resolve('xTrackId'),
                    ],
                    $accomplished
                )
            );

        XLog::info('redirecting to: ' . $merchantCallbackUrl, ['tag' => ($transaction ? $transaction->tagify() : '')]);

        return redirect($merchantCallbackUrl);
    }
}
