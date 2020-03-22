<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authorization Container
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    'otp' =>
    [
        'by_mobile' => 'signup,transfer-money,mobile-verify,reset-pass',
        'by_email' => 'email-verify',
        'daily_limit' => 5,
        'time_gap' => 120, //seconds
        'ip_limit' => 10, // in 48 hours
    ]
];
