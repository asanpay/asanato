<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Otp Container
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    'brokers'              => [
        'mobile' => 'signup,transfer-money,mobile-verify,reset-pass,mobile-verify',
        'email'  => 'email-verify',
    ],
    'ip_check'             => true,
    'ip_limit_hours'       => 48,
    'ip_limit_count'       => 10, // in 48 hours
    'throttle_limit_hours' => 24,
    'throttle_limit_count' => 5,
    'throttle_gap_seconds' => 120, //seconds
    'ttl'                  => '+10 minutes',
];
