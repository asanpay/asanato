<?php

namespace App\Containers\IdentityProof\Actions;

use App\Containers\IdentityProof\Data\Transporters\SearchInIdProofsTransporter;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllIdentityProofsAction extends Action
{
    public function run(SearchInIdProofsTransporter $dto)
    {

        $identityproofs = Apiato::call('IdentityProof@GetAllIdentityProofsTask', [$dto]);

        return $identityproofs;
    }
}
