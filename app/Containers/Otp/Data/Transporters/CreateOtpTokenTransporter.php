<?php

namespace App\Containers\Otp\Data\Transporters;

use App\Ship\Parents\Transporters\Transporter;

class CreateOtpTokenTransporter extends Transporter
{
    /**
     * @var array
     */
    protected $schema = [
        'type'       => 'object',
        'properties' => [
            'mobile', //user mobile
            'email', //user email
            'to', //user mobile/email/....
            'ip', // requester ip
            'ttl' // token ttl
        ],
        'required'   => [
            // define the properties that MUST be set
            'to', //user mobile/email/...
            'ip', // requester ip
        ],
        'default'    => [
            // provide default values for specific properties here
            'ttl'    => 300,
            'ip'     => '0.0.0.0'
        ],
    ];
}
