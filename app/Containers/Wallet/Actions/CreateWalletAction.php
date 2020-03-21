<?php

namespace App\Containers\Wallet\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class CreateWalletAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        $wallet = Apiato::call('Wallet@CreateWalletTask', [$data]);

        return $wallet;
    }
}
