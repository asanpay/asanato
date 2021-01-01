<?php

namespace App\Containers\Wallet\Actions;

use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class GetUserWalletsAction extends Action
{
    public function run(int $userId)
    {
        $wallets = Apiato::call(
            'Wallet@GetAllWalletsTask',
            [],
            [
                'addRequestCriteria',
                [
                    'pushCurrentUserCriteria' => [Apiato::call('User@FindUserByIdTask', [$userId])],
                ],
            ]
        );

        return $wallets;
    }
}
