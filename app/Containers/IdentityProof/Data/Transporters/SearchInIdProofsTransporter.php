<?php

namespace App\Containers\IdentityProof\Data\Transporters;

use App\Ship\Parents\Transporters\Transporter;

class SearchInIdProofsTransporter extends Transporter
{

    /**
     * @var array
     */
    protected $schema = [
        'type' => 'object',
        'properties' => [
            // enter all properties here
            'user_id',
            'type',
            'status',
            'sort_by',
            'sort_dir',
            'page',
            'count',
            // allow for undefined properties
            // 'additionalProperties' => true,
        ],
        'required'   => [
            // define the properties that MUST be set
        ],
        'default'    => [
            'sort_by' => 'id',
            'sort_dir' => 'DESC',
        ]
    ];
}
