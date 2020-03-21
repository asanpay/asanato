<?php

namespace App\Containers\Bank\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteBankAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Bank@DeleteBankTask', [$request->id]);
    }
}
