<?php

namespace App\Containers\Merchant\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class UpdateMerchantAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        $merchant = Apiato::call('Merchant@UpdateMerchantTask', [$request->id, $data]);

        return $merchant;
    }
}
