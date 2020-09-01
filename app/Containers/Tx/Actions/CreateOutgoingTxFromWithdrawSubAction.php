<?php

namespace App\Containers\Tx\Actions;

use App\Containers\Tx\Enum\TxType;
use App\Containers\Wallet\Enum\WalletType;
use App\Containers\Withdrawal\Models\Withdrawal;
use App\Ship\Parents\Actions\SubAction;
use Apiato\Core\Foundation\Facades\Apiato;
use Tartan\Log\Facades\XLog;

class CreateOutgoingTxFromWithdrawSubAction extends SubAction
{
    public function run(Withdrawal $withdrawal)
    {
        // outgoing money wallet
        XLog::debug('create outgoing money tx', [$withdrawal->tagify()]);

        $outgoingMoneyWallet = Apiato::call('Wallet@GetSystemWalletTask', [WalletType::OUTGOING_MONEY]);

        $outgoingTx = [
            'type'          => TxType::SYSTEM,
            'wallet_id'     => $outgoingMoneyWallet->id,
            'user_id'       => $withdrawal->user_id,
            'withdrawal_id' => $withdrawal->id,
            'creditor'      => $withdrawal->amount,
            'ip'            => $withdrawal->ip,
        ];

        Apiato::call('Tx@CreateTxTask', [$outgoingTx]);
    }
}
