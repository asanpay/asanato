<?php

namespace App\Containers\IdentityProof\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllIdentityProofsAction extends Action
{
    public function run(Request $request)
    {
        $identityproofs = Apiato::call('IdentityProof@GetAllIdentityProofsTask', [], ['addRequestCriteria']);

        return $identityproofs;
    }
}
