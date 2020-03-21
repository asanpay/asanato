<?php

namespace App\Containers\Bank\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class FindBankByIdAction extends Action
{
    public function run(Request $request)
    {
        $bank = Apiato::call('Bank@FindBankByIdTask', [$request->id]);

        return $bank;
    }
}
