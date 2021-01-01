<?php

namespace App\Containers\Tx\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class TxRepository
 */
class TxRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
