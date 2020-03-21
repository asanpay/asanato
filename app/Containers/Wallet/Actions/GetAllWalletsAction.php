<?php

namespace App\Containers\Wallet\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllWalletsAction extends Action
{
    public function run(Request $request)
    {
        $wallets = Apiato::call('Wallet@GetAllWalletsTask', [], ['addRequestCriteria']);

        return $wallets;
    }
}
