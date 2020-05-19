<?php

namespace App\Containers\Wallet\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class UpdateWalletAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'name',
            'default'
        ]);

        $wallet = Apiato::call('Wallet@UpdateWalletTask', [$request->id, $data]);

        return $wallet;
    }
}
