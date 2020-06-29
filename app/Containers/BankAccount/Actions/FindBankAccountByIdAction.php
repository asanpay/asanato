<?php

namespace App\Containers\BankAccount\Actions;

use App\Containers\BankAccount\Models\BankAccount;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class FindBankAccountByIdAction extends Action
{
    public function run(int $bankAccountId): ?BankAccount
    {
        return Apiato::call('BankAccount@FindBankAccountByIdTask', [$bankAccountId]);
    }
}
