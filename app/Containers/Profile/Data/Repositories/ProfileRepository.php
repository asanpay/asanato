<?php

namespace App\Containers\Profile\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class ProfileRepository
 */
class ProfileRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
