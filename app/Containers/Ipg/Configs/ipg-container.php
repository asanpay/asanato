<?php

return [
    'internal_callback' => [
        'mobile' => env('APP_URL', 'https://my.asanpay.com') . '/mobile_callback',
        'web'    => env('APP_URL', 'https://my.asanpay.com') . '/wallets'
    ]
];
