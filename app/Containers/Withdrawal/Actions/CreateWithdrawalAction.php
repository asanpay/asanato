<?php

namespace App\Containers\Withdrawal\Actions;

use App\Containers\Tx\Enum\TxType;
use App\Containers\Withdrawal\Exceptions\InsufficientWalletBalanceException;
use App\Containers\Withdrawal\Models\Withdrawal;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Support\Str;

class CreateWithdrawalAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput(
            [
            'amount',
            'wallet_id',
            'bank_account_id',
            'description',
            'payment_id',
            'institution_id',
            ]
        );

        $data['user_id']    = $request->user()->id;
        $data['uid']        = (string)Str::orderedUuid();
        $data['ip'] = $request->ip();

        $wallet      = Apiato::call('Wallet@FindWalletByIdTask', [$data['wallet_id']]);
        $data['fee'] = Apiato::call('Withdrawal@GetUserWithdrawFeeTask', [$request->user()]);

        if ($wallet->getBalance() < ($data['amount'] + $data['fee'])) {
            throw new InsufficientWalletBalanceException();
        }

        $withdrawal = Apiato::call('Withdrawal@CreateWithdrawalTask', [$data]);

        $this->createWalletWithdrawTx($withdrawal);

        // MOVED TO AFTER WITHDRAW ACCOMPLISHMENT
        // create FEE tx
        // Apiato::call('Tx@CreateProfitTxFromWithdrawSubAction', [$withdraw]);

        // create outgoing wallet tx
        // Apiato::call('Tx@CreateOutgoingTxFromWithdrawSubAction', [$withdraw]);

        return $withdrawal;
    }

    private function createWalletWithdrawTx(Withdrawal $withdrawal)
    {
        $data = [
            'type'          => TxType::WITHDRAW,
            'wallet_id'     => $withdrawal->wallet_id,
            'withdrawal_id' => $withdrawal->id,
            'user_id'       => $withdrawal->user_id,
            'debtor'        => $withdrawal->totalAmount(),
            'ip'    => $withdrawal->ip,
        ];

        Apiato::call('Tx@CreateTxTask', [$data]);
    }
}
