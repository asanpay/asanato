<?php

namespace App\Containers\Transaction\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllTransactionsAction extends Action
{
    public function run(Request $request)
    {
        $transactions = Apiato::call('Transaction@GetAllTransactionsTask', [], ['addRequestCriteria']);

        return $transactions;
    }
}
