<?php

namespace App\Containers\Profile\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class FindProfileByIdAction extends Action
{
    public function run(Request $request)
    {
        $profile = Apiato::call('Profile@FindProfileByIdTask', [$request->id]);

        return $profile;
    }
}
