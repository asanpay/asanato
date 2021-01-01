<?php

namespace App\Containers\Transaction\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class CreateTransactionAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput(
            [
            // add your request data here
            ]
        );

        $transaction = Apiato::call('Transaction@CreateTransactionTask', [$data]);

        return $transaction;
    }
}
