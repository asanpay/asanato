<?php

namespace App\Containers\BankAccount\Actions;

use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllBankAccountsAction extends Action
{
    public function run(User $user)
    {
        return Apiato::call('BankAccount@GetAllBankAccountsTask', [], [
            'addRequestCriteria',
            [
                'pushCurrentUserCriteria' => [$user],
            ],
        ]);
    }
}
