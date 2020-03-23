<?php

namespace App\Containers\User\Data\Transporters;

use App\Ship\Parents\Transporters\Transporter;

class UserSignUpTransporter extends Transporter
{
    /**
     * @var array
     */
    protected $schema = [
        'type'       => 'object',
        'properties' => [
            'code',
            'mobile',
            'first_name',
            'last_name',
            'password',
            'client_ip',
            'referrer',
            'device',
            'should_verify_mobile',
        ],
        'required'   => [
            'code',
            'mobile',
            'first_name',
            'last_name',
            'password',
            'client_ip',
        ],
        'default'    => [
            'device'               => 'WEB',
            'should_verify_mobile' => false,
        ],
    ];
}
