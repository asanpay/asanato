<?php

namespace App\Containers\IdentityProof\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteIdentityProofAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('IdentityProof@DeleteIdentityProofTask', [$request->id]);
    }
}
