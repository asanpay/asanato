<?php

namespace App\Containers\Tx\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteTxAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Tx@DeleteTxTask', [$request->id]);
    }
}
