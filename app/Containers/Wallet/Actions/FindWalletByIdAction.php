<?php

namespace App\Containers\Wallet\Actions;

use App\Containers\Wallet\Models\Wallet;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class FindWalletByIdAction extends Action
{
    public function run(Request $request): Wallet
    {
        $wallet = Apiato::call('Wallet@FindWalletByIdTask', [$request->id]);

        return $wallet;
    }
}
