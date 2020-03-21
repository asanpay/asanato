<?php

namespace App\Containers\Helpdesk\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteHelpdeskAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Helpdesk@DeleteHelpdeskTask', [$request->id]);
    }
}
