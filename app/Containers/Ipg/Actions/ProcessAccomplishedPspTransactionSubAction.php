<?php


namespace App\Containers\Ipg\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Transaction\Models\Transaction;
use App\Containers\Tx\Enum\TxType;
use App\Containers\Wallet\Enum\WalletType;
use App\Exception;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\DB;
use Tartan\Log\Facades\XLog;

class ProcessAccomplishedPspTransactionSubAction extends Action
{
    public function run(Transaction $transaction): void
    {
        if (!empty($transaction->wallet_id)) {
            // top-up wallet transaction
            $this->processWalletTopUp($transaction);
        }
    }

    protected function processWalletTopUp(Transaction $transaction)
    {
        // if transaction was wallet top-up transaction then verification is not required and
        // we should accomplish it immediately after verification

        // check if transaction is ready for accomplishment or not
        if ($transaction->isReadyFoAccomplish()) {
            if ($transaction->setAccomplished() == false) {
                throw new Exception('could not accomplish the transaction', [$transaction->tagify()]);
            } else {
                // ** transaction accomplishment was successful **
                // create transaction related Txes

                XLog::info('creating top-up wallet txes', [$transaction->tagify()]);
                DB::transaction(function () use (&$transaction) {
                    // incoming money wallet
                    // create incoming wallet Tx
                    Apiato::call('Tx@CreateIncomeTxFromTransactionSubAction', [$transaction]);

                    // destination wallet
                    XLog::debug('create destination wallet tx');
                    $dstWallet   = Apiato::call('Wallet@FindWalletByIdTask', [$transaction->wallet_id]);
                    $dstWalletTx = [
                        'type'           => TxType::TOP_UP,
                        'wallet_id'      => $dstWallet->id,
                        'user_id'        => $dstWallet->user_id,
                        'transaction_id' => $transaction->id,
                        'creditor'       => $transaction->merchant_share,
                        'ip_address'     => $transaction->ip_address,
                        'meta'           => [
                            'raw_amount'     => $transaction->payable_amount,
                        ]
                    ];
                    // add transaction description to TX of destination wallet
                    if (isset($transaction->meta['description'])) {
                        $dstWalletTx['meta']['description'] = $transaction->meta['description'];
                    }
                    Apiato::call('Tx@CreateTxTask', [$dstWalletTx]);

                    // in case of the transaction has benefit for system
                    if ($transaction->benefit > 0) {
                        XLog::debug('create profit tx');
                        $profitWallet = Apiato::call('Wallet@GetSystemWalletTask', [WalletType::PROFIT]);
                        $profitTx     = [
                            'type'           => TxType::PROFIT,
                            'wallet_id'      => $profitWallet->id,
                            'user_id'        => config('settings.app_user_id'),
                            'transaction_id' => $transaction->id,
                            'creditor'       => $transaction->benefit,
                            'ip_address'     => $transaction->ip_address,
                        ];
                        Apiato::call('Tx@CreateTxTask', [$profitTx]);
                    }
                }, 3);
            }
        } else {
            throw new Exception('The wallet top-up transaction is not ready for accomplishment process!');
        }
    }
}
