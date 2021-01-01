<?php

namespace App\Containers\Transaction\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class TransactionRepository
 */
class TransactionRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
