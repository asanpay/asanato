<?php

namespace App\Containers\Helpdesk\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class FindHelpdeskByIdAction extends Action
{
    public function run(Request $request)
    {
        $helpdesk = Apiato::call('Helpdesk@FindHelpdeskByIdTask', [$request->id]);

        return $helpdesk;
    }
}
