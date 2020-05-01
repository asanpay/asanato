<?php


namespace App\Containers\Ipg\Actions;

use App\Containers\Ipg\UI\WEB\Requests\IpgGatewayPageRequest;
use App\Containers\Transaction\Enum\TransactionStatus;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use Asanpay\Shaparak\Facades\Shaparak;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Tartan\Log\Facades\XLog;

class GatewayPageAction extends Action
{
    public function run(string $token, IpgGatewayPageRequest $request)
    {
        try {

            // validate token
            $validator = Validator::make(['token' => $token], [
                'token' => [
                    'required',
                    'alpha_dash',
                    'regex:' . config('regex.token_regex'),
                ],
            ]);

            if ($validator->fails()) {
                return view('ipg::gate')->withErrors([__('ipg.transaction_not_found')]);
            }

            // find the transaction by token
            $transaction = Apiato::call('Transaction@FindTransactionByPublicTokenTask', [$token]);

            if (!$transaction) {
                return view('ipg::gate')->withErrors([__('ipg.transaction_not_found')]);
            }

            // check for founded transaction status
            if ($transaction->status >= TransactionStatus::VERIFIED) {
                return view('ipg::gate')->withErrors([__('ipg.transaction_processed_before')]);
            }

            // check if user requested a default ps or not
            $meta = $transaction->getJsonb();

            // Start to verify the transaction \\
            $availableGateways = Apiato::call('Bank@GetAvailableGatewaysTask', [
                $meta->direct ?? true,
                $meta->refund ?? false,
                true,
                ['mode' => config('shaparak.mode')] // patch shaparak mode into gateway properties
            ]);

            if ($availableGateways->count() < 1) {
                return view('ipg::gate')->withErrors([__('ipg.no_active_gate_found')]);
            }

            // try to get gateway form one of the available gateways. try one by one
            foreach ($availableGateways as $paymentGateway) {
                try {
                    // create an instance of Shaparak component
                    XLog::info('trying to get psp gateway token by', $paymentGateway->properties);

                    $form = Shaparak::with($paymentGateway->psp, $transaction, $paymentGateway->properties)->getForm();

                    XLog::info('got gateway form: ' . $form);

                    // update psp detail for the transaction
                    $transaction->updatePspInfo($paymentGateway->psp_id, $paymentGateway->id);

                    break; // PSP defined

                } catch (\Exception $e) {
                    // could not generate goto gate form
                    XLog::debug('request token throws EXCEPTION');
                    XLog::exception($e);

                    continue;
                }
            }
            if (!isset($form)) {
                XLog::error('gateway form in empty');
                Session::flash('alert-danger', $e->getMessage());
            }
        } catch (\Exception $e) {
            XLog::exception($e);

            return view('ipg::gate')->withErrors([$e->getMessage()]);
        }
        $form = $form ?? '<a href="?shetab" class="btn btn-info btn-sm btn-block mx-3"><i class="fa fa-credit-card"></i> '.__('ipg.shetab_payment').'</a>';


        // view goto gate view
        return view('ipg::gate', [
            'transaction' => $transaction,
            'gateway'     => $paymentGateway,
            'merchant'    => $transaction->merchant,
            'form'        => $form,
        ]);
    }
}
