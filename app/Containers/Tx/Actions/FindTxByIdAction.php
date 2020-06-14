<?php

namespace App\Containers\Tx\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class FindTxByIdAction extends Action
{
    public function run(Request $request)
    {
        $tx = Apiato::call('Tx@FindTxByIdTask', [$request->id]);

        return $tx;
    }
}
