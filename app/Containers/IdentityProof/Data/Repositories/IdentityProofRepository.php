<?php

namespace App\Containers\IdentityProof\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class IdentityProofRepository
 */
class IdentityProofRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
