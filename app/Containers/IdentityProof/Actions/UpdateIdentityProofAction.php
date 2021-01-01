<?php

namespace App\Containers\IdentityProof\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class UpdateIdentityProofAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput(
            [
            // add your request data here
            ]
        );

        $identityproof = Apiato::call('IdentityProof@UpdateIdentityProofTask', [$request->id, $data]);

        return $identityproof;
    }
}
