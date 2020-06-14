<?php

namespace App\Containers\Tx\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllTxesAction extends Action
{
    public function run(Request $request)
    {
        $txes = Apiato::call('Tx@GetAllTxesTask', [], ['addRequestCriteria']);

        return $txes;
    }
}
