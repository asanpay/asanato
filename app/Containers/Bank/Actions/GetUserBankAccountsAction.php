<?php

namespace App\Containers\Bank\Actions;

use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class GetUserBankAccountsAction extends Action
{
    public function run(User $user)
    {
        return Apiato::call('Bank@GetAllBankAccountsTask', [], [
            'addRequestCriteria',
            [
                'pushCurrentUserCriteria' => [$user],
            ],
        ]);
    }
}
