<?php

namespace App\Containers\Withdrawal\Actions;

use App\Containers\Tx\Enum\TxType;
use App\Containers\Withdrawal\Enum\WithdrawalStatus;
use App\Containers\Withdrawal\Exceptions\CouldNotChangeFinalizedWithdrawException;
use App\Containers\Withdrawal\Models\Withdrawal;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class RejectWithdrawalAction extends Action
{
    public function run(Request $request)
    {
        $withdrawal = Apiato::call('Withdrawal@FindWithdrawalByIdTask', [$request->id]);

        if ($withdrawal->status > WithdrawalStatus::PROCESSING) {
            throw new CouldNotChangeFinalizedWithdrawException();
        }

        $this->createWithdrawCorrectionTransaction($withdrawal, $request->ip());

        return Apiato::call('Withdrawal@RejetWithdrawalTask', [
            $withdrawal,
            $request->user()->id,
            $request->ip(),
            $request->input('reject_reason')
        ]);
    }

    private function createWithdrawCorrectionTransaction(Withdrawal $withdrawal, string $ip)
    {
        $data = [
            'type'          => TxType::CORRECTION,
            'wallet_id'     => $withdrawal->wallet_id,
            'withdrawal_id' => $withdrawal->id,
            'user_id'       => $withdrawal->user_id,
            'creditor'      => $withdrawal->totalAmount(),
            'ip'            => $ip,
            'meta'          => [
                'description' => trans('withdrawal::withdraw.withdraw_correction_tx', ['id' => $withdrawal->id]),
            ],
        ];

        Apiato::call('Tx@CreateTxTask', [$data]);
    }
}
