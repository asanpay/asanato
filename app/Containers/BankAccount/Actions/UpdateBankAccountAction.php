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
            'iban',
            'default',
            'status',
        ]);

        $bankAccount = Apiato::call('BankAccount@FindBankAccountByIdTask', [$request->id]);

        if ($bankAccount->isApproved()) {
            // because we could not changed IBAN and bank of Approved accounts
            unset($data['iban'], $data['bank_id']);
        }

        if ($request->user()->can('update-bank-accounts') !== true) {
            // because normal user could not change the bank account status
            unset($data['status']);
        }

        $bankaccount = Apiato::transactionalCall('BankAccount@UpdateBankAccountTask', [$request->id, $data]);

        return $bankaccount;
    }
}
