<?php

namespace App\Containers\Transaction\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class UpdateTransactionAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput(
            [
            // add your request data here
            ]
        );

        $transaction = Apiato::call('Transaction@UpdateTransactionTask', [$request->id, $data]);

        return $transaction;
    }
}
