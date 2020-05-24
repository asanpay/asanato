<?php

namespace App\Containers\Otp\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class OtpTokenRepository extends Repository
{

    /**
     * the container name. Must be set when the model has different name than the container
     *
     * @var  string
     */
    protected $container = 'Otp';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code'         => '=',
        'via'          => 'like',
    ];

}
