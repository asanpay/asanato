<?php

namespace App\Containers\Bank\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class BankRepository
 */
class BankAccountRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        'iban' => '=',
        'status' => '=',
        'default' => '=',
    ];

}
