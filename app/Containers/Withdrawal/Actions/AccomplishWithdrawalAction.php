<?php

namespace App\Containers\Withdrawal\Actions;

use App\Containers\Withdrawal\Enum\WithdrawalStatus;
use App\Containers\Withdrawal\Exceptions\CouldNotChangeFinalizedWithdrawException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class AccomplishWithdrawalAction extends Action
{
    public function run(Request $request)
    {
        $withdrawal = Apiato::call('Withdrawal@FindWithdrawalByIdTask', [$request->id]);

        if ($withdrawal->status > WithdrawalStatus::PROCESSING) {
            throw new CouldNotChangeFinalizedWithdrawException();
        }

        // create FEE tx
        Apiato::call('Tx@CreateProfitTxFromWithdrawSubAction', [$withdrawal]);

        // create outgoing wallet tx
        Apiato::call('Tx@CreateOutgoingTxFromWithdrawSubAction', [$withdrawal]);

        return Apiato::call(
            'Withdrawal@AccomplishWithdrawalTask',
            [
                $withdrawal,
                $request->user()->id,
                $request->ip(),
                $request->input('tracking_id')
            ]
        );
    }
}
