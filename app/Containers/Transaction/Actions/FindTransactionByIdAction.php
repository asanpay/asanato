<?php

namespace App\Containers\Transaction\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class FindTransactionByIdAction extends Action
{
    public function run(Request $request)
    {
        $transaction = Apiato::call('Transaction@FindTransactionByIdTask', [$request->id]);

        return $transaction;
    }
}
