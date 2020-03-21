<?php

namespace App\Containers\Wallet\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteWalletAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Wallet@DeleteWalletTask', [$request->id]);
    }
}
