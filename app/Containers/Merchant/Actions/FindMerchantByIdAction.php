<?php

namespace App\Containers\Merchant\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class FindMerchantByIdAction extends Action
{
    public function run(Request $request)
    {
        $merchant = Apiato::call('Merchant@FindMerchantByIdTask', [$request->id]);

        return $merchant;
    }
}
