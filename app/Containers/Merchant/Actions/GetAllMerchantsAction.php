<?php

namespace App\Containers\Merchant\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllMerchantsAction extends Action
{
    public function run(Request $request)
    {
        $merchants = Apiato::call('Merchant@GetAllMerchantsTask', [], ['addRequestCriteria']);

        return $merchants;
    }
}
