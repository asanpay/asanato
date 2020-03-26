<?php

namespace App\Containers\User\Data\Transporters;

use App\Ship\Parents\Transporters\Transporter;

class UserUpdateProfileTransporter extends Transporter
{

    /**
     * @var array
     */
    protected $schema = [
        'type' => 'object',
        'properties' => [
            'gender',
            'first_name',
            'last_name',
            'type',
            'company',
            'financial_id',
            'email',
            'mobile',
            'tel',
            'national_id',
            'location_id',
            'address',
            'zip',
            'birth_date',
        ],
        'required'   => [
            // define the properties that MUST be set
        ],
        'default'    => [
            // provide default values for specific properties here
        ]
    ];
}
