<?php

namespace App\Containers\BankAccount\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteBankAccountAction extends Action
{
    public function run(Request $request)
    {
        $bankAccount = Apiato::call('BankAccount@FindBankAccountByIdTask', [$request->id]);

        if ($bankAccount->isDefault()) {
            // flag another bank account as user's default bank account
            Apiato::call('BankAccount@MakeAnotherBankAccountDefaultTask', [$request->id]);
        }
        return Apiato::call('BankAccount@DeleteBankAccountTask', [$request->id]);
    }
}
