<?php

namespace App\Containers\IdentityProof\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class FindIdentityProofByIdAction extends Action
{
    public function run(Request $request)
    {
        $identityproof = Apiato::call('IdentityProof@FindIdentityProofByIdTask', [$request->id]);

        return $identityproof;
    }
}
