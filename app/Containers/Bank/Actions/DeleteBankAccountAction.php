<?php

namespace App\Containers\Bank\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteBankAccountAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Bank@DeleteBankAccountTask', [$request->id]);
    }
}
