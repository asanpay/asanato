<?php

namespace App\Containers\BankAccount\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class FindBankAccountByIdAction extends Action
{
    public function run(Request $request)
    {
        $bankaccount = Apiato::call('BankAccount@FindBankAccountByIdTask', [$request->id]);

        return $bankaccount;
    }
}
