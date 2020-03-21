<?php

namespace App\Containers\Bank\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllBanksAction extends Action
{
    public function run(Request $request)
    {
        $banks = Apiato::call('Bank@GetAllBanksTask', [], ['addRequestCriteria']);

        return $banks;
    }
}
