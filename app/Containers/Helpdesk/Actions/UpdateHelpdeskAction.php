<?php

namespace App\Containers\Helpdesk\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class UpdateHelpdeskAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        $helpdesk = Apiato::call('Helpdesk@UpdateHelpdeskTask', [$request->id, $data]);

        return $helpdesk;
    }
}
