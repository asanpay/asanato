<?php

namespace App\Containers\User\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class UserRepository.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name' => 'like',
        'last_name'  => 'like',
        'id'         => '=',
        'email'      => '=',
        'confirmed'  => '=',
        'created_at' => 'like',
    ];
}
