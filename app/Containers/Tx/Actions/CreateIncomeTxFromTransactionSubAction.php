<?php

namespace App\Containers\Tx\Actions;

use App\Containers\Transaction\Models\Transaction;
use App\Containers\Tx\Enum\TxType;
use App\Containers\Wallet\Enum\WalletType;
use App\Ship\Parents\Actions\SubAction;
use Apiato\Core\Foundation\Facades\Apiato;
use Tartan\Log\Facades\XLog;

class CreateIncomeTxFromTransactionSubAction extends SubAction
{
    public function run(Transaction $transaction)
    {
        // incoming money wallet
        XLog::debug('create incoming money tx', [$transaction->tagify()]);

        $incomingMoneyWallet = Apiato::call('Wallet@GetSystemWalletTask', [WalletType::INCOMING_MONEY]);

        $incomingTx          = [
            'type'           => TxType::SYSTEM,
            'wallet_id'      => $incomingMoneyWallet->id,
            'user_id'        => config('settings.app_user_id'),
            'transaction_id' => $transaction->id,
            'debtor'         => $transaction->payable_amount,
            'ip_address'     => $transaction->ip_address,
        ];
        Apiato::call('Tx@CreateTxTask', [$incomingTx]);
    }
}
