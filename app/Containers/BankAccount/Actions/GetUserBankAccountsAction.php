<?php

namespace App\Containers\BankAccount\Actions;

use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class GetUserBankAccountsAction extends Action
{
    public function run(int $userId)
    {
        return Apiato::call(
            'BankAccount@GetBankAccountsTask',
            [],
            [
            'addRequestCriteria',
            [
                'pushCurrentUserCriteria' => [Apiato::call('User@FindUserByIdTask', [$userId])],
            ],
            ]
        );
    }
}
