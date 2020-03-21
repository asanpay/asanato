<?php

namespace App\Containers\Profile\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllProfilesAction extends Action
{
    public function run(Request $request)
    {
        $profiles = Apiato::call('Profile@GetAllProfilesTask', [], ['addRequestCriteria']);

        return $profiles;
    }
}
