<?php

namespace App\Containers\BankAccount\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class UpdateBankAccountAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        $bankaccount = Apiato::call('BankAccount@UpdateBankAccountTask', [$request->id, $data]);

        return $bankaccount;
    }
}
