<?php

namespace App\Containers\BankAccount\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteBankAccountAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('BankAccount@DeleteBankAccountTask', [$request->id]);
    }
}
