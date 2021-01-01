<?php

namespace App\Containers\Wallet\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class UpdateWalletAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput(
            [
            'name',
            'default',
            'user_id'
            ]
        );

        if (Apiato::call('Wallet@FindWalletByIdTask', [$request->id])->isDefault()) {
            // user could not change default status of default wallet
            unset($data['default']);
        }

        $wallet = Apiato::transactionalCall('Wallet@UpdateWalletTask', [$request->id, $data]);

        return $wallet;
    }
}
