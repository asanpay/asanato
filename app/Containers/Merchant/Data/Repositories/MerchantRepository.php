<?php

namespace App\Containers\Merchant\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class MerchantRepository
 */
class MerchantRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
