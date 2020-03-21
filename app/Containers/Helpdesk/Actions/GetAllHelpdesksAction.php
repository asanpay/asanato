<?php

namespace App\Containers\Helpdesk\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllHelpdesksAction extends Action
{
    public function run(Request $request)
    {
        $helpdesks = Apiato::call('Helpdesk@GetAllHelpdesksTask', [], ['addRequestCriteria']);

        return $helpdesks;
    }
}
