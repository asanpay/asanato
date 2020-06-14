<?php

namespace App\Containers\Tx\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class CreateTxAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        $tx = Apiato::call('Tx@CreateTxTask', [$data]);

        return $tx;
    }
}
