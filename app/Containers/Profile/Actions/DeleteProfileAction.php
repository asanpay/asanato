<?php

namespace App\Containers\Profile\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteProfileAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Profile@DeleteProfileTask', [$request->id]);
    }
}
