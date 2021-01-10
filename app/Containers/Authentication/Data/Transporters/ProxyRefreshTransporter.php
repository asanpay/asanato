<?php

namespace App\Containers\Authentication\Data\Transporters;

use App\Ship\Parents\Transporters\Transporter;

/**
 * Class ProxyRefreshTransporter
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class ProxyRefreshTransporter extends Transporter
{

    /**
     * @var array
     */
    protected $schema = [
        'type' => 'object',
        'properties' => [
            'refresh_token',
            'client_id',
            'client_password',
            'grant_type',
            'scope',
        ],
        'required'   => [
            'refresh_token',
            'client_id',
            'client_password',
        ],
        'default'    => [
            'scope' => '',
        ]
    ];
}
