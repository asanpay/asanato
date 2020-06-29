<?php

/**
 * @apiGroup           Wallet
 * @apiName            UpdateWallet
 *
 * @api                {PATCH} /v1/users/{user_id}/wallets/:id UpdateWallet
 * @apiDescription     Update wallet data
 *
 * @apiVersion         1.0.0
 * @apiPermission      update-wallets
 *
 * @apiParam           {String} id  hashed wallet id
 * @apiParam           {String} name  wallet name
 * @apiParam           {Boolean} default  make wallet the default wallet
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
    "data": {
    "object": "Wallet",
        "id": "vmg6q36wmk4w8kzr",
        "name": "foobarbaz",
        "raw_balance": 10000000,
        "locked_balance": 0,
        "balance": 10000000,
        "transfer_limit": 1000000,
        "default": true,
        "j_created_at": "۱۳۹۹/۰۳/۰۷ ۰:۴۵:۳۰",
        "created_at": "2020-05-27 00:45:30",
        "updated_at": "2020-05-27 00:46:00"
    },
    "meta": {
    "include": [],
        "custom": []
    },
    "message": "everything's ok",
    "code": 0,
    "xTrackId": "1741fdb6d2"
}
 */


/** @var Route $router */
$router->patch('users/{user_id}/wallets/{id}', [
    'as' => 'api_wallet_update_wallet',
    'uses'  => 'Controller@updateWallet',
    'middleware' => [
      'auth:api',
    ],
]);
