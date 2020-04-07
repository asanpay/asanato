<?php


namespace App\Containers\Ipg\Actions;

use App\Containers\Ipg\UI\WEB\Requests\IpgTransactionCallbackRequest;
use App\Containers\Transaction\Enum\TransactionStatus;
use App\Containers\Transaction\Enum\TransactionType;
use App\Containers\Transaction\Models\Transaction;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use Asanpay\Shaparak\Facades\Shaparak;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Tartan\Log\Facades\XLog;

class TransactionCallbackAction extends Action
{
    public function run(string $psp, string $gateway, string $token, IpgTransactionCallbackRequest $request)
    {
        $paidSuccessfully = false;

        do {
            try {

                $validator = Validator::make([
                    'token'   => $token,
                    'psp'     => $psp,
                    'gateway' => $gateway,
                ], [
                    'token'   => [
                        'required',
                        'alpha_dash',
                        'regex:' . config('regex.token_regex'),
                    ],
                    'psp'     => [
                        'required',
                        'alpha_dash',
                    ],
                    'gateway' => [
                        'required',
                        'regex:' . config('regex.gateway_regex'),
                    ],
                ]);

                // validate required route parameters
                if ($validator->fails()) {
                    return view('ipg::callback')->withErrors([__('Code N1 - Transaction not found')]);
                }

                // find the transaction by token
                $transaction = Apiato::call('Transaction@FindTransactionByPublicTokenTask', [$token]);

                // transaction not found
                if (!$transaction) {
                    return view('ipg::callback')->withErrors([__('Code N2 - Transaction not found')]);
                }

                // basic check for equal PSP
                if ($transaction->psp->slug != $psp) {
                    return view('ipg::callback')->withErrors([__('Code N3 - Transaction not found')]);
                }

                // patch `shaparak mode` into gateway properties that fetched from gateway row
                $gatewayProperties = $transaction->gateway->getRealtimeProperties(['mode' => config('shaparak.mode')]);

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
                    // update transaction`s callback parameter
                    $transaction->setCallBackParameters($request->all());

//                    // check for founded transaction status
//                    if ($transaction->status > TransactionStatus::CALLBACK) {
//                        return view('ipg.gate')->withErrors([__('The Transaction has been verified before')]);
//                    }

                    // extract PSP gateway`s reference Id from the posted callback parameters
                    $referenceId = $shaparak->getGatewayReferenceId();

                    $doubleSpending = Apiato::cal('Transaction@TransactionHasDoubleSpendingTask', [$transaction, $referenceId, $request]);

                    if ($doubleSpending) {
                        Session::flash('alert-danger', trans('ipg.double_spending'));
                        break;
                    }
                }

                // start to verify the transaction ---------------------------------------------------------------------
                if ($transaction->status < TransactionStatus::VERIFIED) {
                    $verified = false;

                    for ($i = 1; $i <= 3; $i++) {
                        try {
                            XLog::info('trying to verify payment',
                                [
                                    'try'  => $i,
                                    'ref'  => $referenceId,
                                    'gate' => $gateway,
                                    'psp'  => $psp,
                                    $transaction->tagify(),
                                ]);

                            $verifyResult = $shaparak->verifyTransaction();

                            if ($verifyResult === true) {
                                $verified = true;
                            }
                            XLog::info('verify result',
                                [
                                    'try'    => $i,
                                    'ref'    => $referenceId,
                                    'gate'   => $gateway,
                                    'psp'    => $psp,
                                    'result' => $verifyResult,
                                    $transaction->tagify(),
                                ]);
                            break;
                        } catch (Exception $e) {
                            XLog::error('Exception: ' . $e->getMessage(),
                                [
                                    'try'    => $i,
                                    'ref'    => $referenceId,
                                    'gate'   => $gateway,
                                    'psp'    => $psp,
                                    'result' => $verifyResult ?? '',
                                    $transaction->tagify(),
                                ]);
                            continue;
                        }
                    }

                    if ($verified !== true) {
                        XLog::error('transaction verification failed',
                            ['ref' => $referenceId, 'gate' => $gateway, 'psp' => $psp, $transaction->tagify()]);
                        break;
                    } else {
                        XLog::info('invoice verified successfully',
                            ['ref' => $referenceId, 'gate' => $gateway, 'psp' => $psp, $transaction->tagify()]);
                    }
                }
                // verify end ------------------------------------------------------------------------------------------
                XLog::info("invoice status change to $transaction->status after verification",
                    [$transaction->tagify()]);


                // settle start ----------------------------------------------------------------------------------
                if ($transaction->status < TransactionStatus::SETTLED) {
                    $afterVerified = false;
                    for ($i = 1; $i <= 3; $i++) {
                        try {
                            XLog::info('trying to settle payment',
                                [
                                    'try'  => $i,
                                    'ref'  => $referenceId,
                                    'gate' => $gateway,
                                    'psp'  => $psp,
                                    $transaction->tagify(),
                                ]);

                            $settleResult = $shaparak->settleTransaction();
                            if ($settleResult) {
                                $afterVerified = true;
                            }
                            XLog::info('settle result', [
                                'try'    => $i,
                                'ref'    => $referenceId,
                                'gate'   => $gateway,
                                'psp'    => $psp,
                                'result' => $verifyResult,
                                $transaction->tagify(),
                            ]);
                            break;
                        } catch (\Exception $e) {
                            XLog::error('Exception: ' . $e->getMessage(),
                                [
                                    'try'    => $i,
                                    'ref'    => $referenceId,
                                    'gate'   => $gateway,
                                    'psp'    => $psp,
                                    'result' => $verifyResult ?? '',
                                    $transaction->tagify(),
                                ]);
                            continue;
                        }
                    }

                    if ($afterVerified !== true) {
                        XLog::error('transaction settlement failed',
                            ['ref' => $referenceId, 'gate' => $gateway, 'psp' => $psp, $transaction->tagify()]);
                        break;
                    } else {
                        XLog::info('invoice settled successfully',
                            ['ref' => $referenceId, 'gate' => $gateway, 'psp' => $psp, $transaction->tagify()]);
                    }
                }

                if ($transaction->type = TransactionType::WALLET_TOPUP) {
                    // if transaction was wallet topup transaction then verification is not required and
                    // we should accomplish it immediately after verification
                    if ($transaction->isReadyAccomplish()) {
                        // check if transaction is ready for accomplishment or not
                        if ($transaction->setAccomplished() == false) {
                            throw new Exception('Could not accomplish transaction');
                        }
                    } else {
                        throw new Exception('The transaction is not ready for accomplishment process!');
                    }
                }

                // settle end ------------------------------------------------------------------------------------
                XLog::info("invoice status change to $transaction->status after settlement",
                    [$transaction->tagify()]);

                $paidSuccessfully = true;

            } catch (Exception $e) {
                $p = [];
                if (isset($transaction) && $transaction instanceof Transaction) {
                    $p[] = $transaction->tagify();
                }
                XLog::emergency($e->getMessage() . ' code:' . $e->getCode() . ' ' . $e->getFile() . ':' . $e->getLine(),
                    $p);
                break;
            }

        } while (false); // do not repeat

        $merchantCallbackUrl = $transaction->callback_url . '?' . http_build_query([
                'status'      => $paidSuccessfully ? 'OK' : 'NOK',
                'status_code' => $paidSuccessfully ? 0 : -1,
                'token'       => $token,
                'x_track_id'  => resolve('xTrackId'),
            ]);

        XLog::info('redirecting to: ' . $merchantCallbackUrl, ['tag' => ($transaction ? $transaction->tagify() : '')]);

        return redirect($merchantCallbackUrl);
    }
}
