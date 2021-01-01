<?php

namespace App\Containers\Withdrawal\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class WithdrawalRepository
 */
class WithdrawalRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
