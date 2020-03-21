<?php

namespace App\Containers\Helpdesk\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class CreateHelpdeskAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        $helpdesk = Apiato::call('Helpdesk@CreateHelpdeskTask', [$data]);

        return $helpdesk;
    }
}
