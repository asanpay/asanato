<?php

/**
 *  *** ALL finance values are in Rial currency ***
 */
return [
    'wages' => [
        'wallet' => [
            'create' => 10000,
        ],
    ],
    'limit' => [
        'psp' => [
            'min' => 1000,
            'max' => 500000000
        ],
        'transfer' => [
            'min' => 10000,
            'max' => env('WALLET_TRANSFER_LIMIT', 1000000)
        ]
    ]
];
