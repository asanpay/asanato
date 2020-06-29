<?php

namespace App\Containers\Wallet\Actions;

use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteWalletAction extends Action
{
    public function run(int $userId, int $walletId)
    {

        if (Apiato::call('Wallet@GetAllWalletsTask', [], [
                'addRequestCriteria',
                [
                    'pushCurrentUserCriteria' => [Apiato::call('User@FindUserByIdTask', [$userId])],
                ],
            ])->count() < 2) {
            // User should have at least one active wallet
            throw new DeleteResourceFailedException('User should have at least one active wallet');
        }



        return Apiato::call('Wallet@DeleteWalletTask', [$walletId]);
    }
}
