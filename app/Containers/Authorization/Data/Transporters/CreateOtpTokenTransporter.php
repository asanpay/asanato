<?php

namespace App\Containers\Authorization\Data\Transporters;

use App\Containers\Authorization\Enum\OtpDriver;
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
            'via', //user mobile/email/...
            'driver', // sms/email/...
            'ip', // requester ip
            'ttl' // token ttl
        ],
        'required'   => [
            // define the properties that MUST be set
            'via', //user mobile/email/...
            'ip', // requester ip
        ],
        'default'    => [
            // provide default values for specific properties here
            'ttl'    => 300,
            'driver' => OtpDriver::SMS,
        ],
    ];
}
