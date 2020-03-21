<?php

namespace App\Containers\Merchant\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteMerchantAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Merchant@DeleteMerchantTask', [$request->id]);
    }
}
