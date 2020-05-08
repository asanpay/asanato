<?php

namespace App\Containers\Wallet\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class WalletRepository
 */
class WalletTransactionRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
