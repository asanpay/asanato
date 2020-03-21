<?php

namespace App\Containers\Merchant\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class CreateMerchantAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        $merchant = Apiato::call('Merchant@CreateMerchantTask', [$data]);

        return $merchant;
    }
}
