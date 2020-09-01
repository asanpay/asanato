<?php

namespace App\Containers\Tx\Actions;

use App\Containers\Transaction\Models\Transaction;
use App\Containers\Tx\Enum\TxType;
use App\Containers\Wallet\Enum\WalletType;
use App\Containers\Wallet\Models\Wallet;
use App\Ship\Parents\Actions\SubAction;
use Apiato\Core\Foundation\Facades\Apiato;
use Tartan\Log\Facades\XLog;

class CreateProfitTxFromTransactionSubAction extends SubAction
{
    protected Wallet $wallet;

    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    public function run(Transaction $transaction): void
    {
        // add profit of accomplished merchant transaction to `transaction profit wallet`
        XLog::debug('transaction profit tx', [$transaction->tagify()]);

        $profitWallet = Apiato::call('Wallet@GetSystemWalletTask', [WalletType::PROFIT]);

        if ($transaction->profit > 0) {
            $incomingTx = [
                'type'           => TxType::PROFIT,
                'wallet_id'      => $profitWallet->id,
                'user_id'        => $transaction->user_id,
                'transaction_id' => $transaction->id,
                'creditor'       => $transaction->profit,
                'gateway_id'     => $transaction->gateway_id,
                'ip'             => $transaction->ip,
                'meta'           => [
                    'description' => trans('wallet::wallet.acmp_inc_profit', ['id' => $transaction->id]),
                ],
            ];
            Apiato::call('Tx@CreateTxTask', [$incomingTx]);
        }
    }
}
