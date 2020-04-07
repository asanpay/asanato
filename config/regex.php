<?php
return [
    'mobile_regex' => '/^(0)*9\d{9}$/',
    'tel_regex' => '/^(0)*\d{5,}$/',
    'token_regex' => '/^' . config('app.abrv', 'AP') . '[A-Z]{2}\-\d+$/',
    'refund_token_regex' => '/^REFUND\-\w+$/',
    'gateway_regex' => '/^\d+$/',
    'psp_regex' => '/^[a-z]+$/',
];
