<?php

namespace App\Containers\Wallet\Actions;

use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class GetUserWalletsAction extends Action
{
    public function run(User $user)
    {
        $wallets = Apiato::call('Wallet@GetAllWalletsTask', [], [
            'addRequestCriteria',
            [
                'pushCurrentUserCriteria' => [$user],
            ],
        ]);

        return $wallets;
    }
}
