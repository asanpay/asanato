<?php

namespace App\Containers\Wallet\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetUserWalletsAction extends Action
{
    public function run(Request $request)
    {
        $wallets = Apiato::call('Wallet@GetUserWalletsTask', [$request->user()], ['addRequestCriteria']);

        return $wallets;
    }
}
