<?php

namespace App\Containers\BankAccount\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class BankAccountRepository
 */
class BankAccountRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        'user_id' => '=',
        'iban' => '=',
        'status' => '=',
        'default' => '=',
    ];
}
