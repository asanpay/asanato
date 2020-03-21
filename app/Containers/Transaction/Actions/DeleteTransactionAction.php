<?php

namespace App\Containers\Transaction\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteTransactionAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Transaction@DeleteTransactionTask', [$request->id]);
    }
}
