<?php

namespace App\Containers\Tx\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class UpdateTxAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        $tx = Apiato::call('Tx@UpdateTxTask', [$request->id, $data]);

        return $tx;
    }
}
