<?php

namespace App\Containers\Profile\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class CreateProfileAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        $profile = Apiato::call('Profile@CreateProfileTask', [$data]);

        return $profile;
    }
}
