<?php

namespace App\Containers\Helpdesk\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class HelpdeskRepository
 */
class HelpdeskRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
