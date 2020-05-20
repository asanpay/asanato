<?php

/**
 * @apiGroup           Wallet
 * @apiName            CreateWallet
 *
 * @api                {POST} /v1/wallets CreateWallet
 * @apiDescription     Create a user wallet
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  name
 * @apiParam           {Boolean}  default
 * @apiParam           {String}  payer_wallet_id The wallet that should pay the wage
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK

{
    "data": {
    "object": "Wallet",
        "id": "6l8b75dw6e3qkv9z",
        "name": "foo",
        "raw_balance": null,
        "locked_balance": null,
        "balance": 0,
        "transfer_limit": 1000000,
        "default": null,
        "j_created_at": "۱۳۹۹/۰۲/۱۹ ۲۳:۴۹:۵۳",
        "created_at": "2020-05-08T19:19:53.000000Z",
        "updated_at": "2020-05-08T19:19:53.000000Z"
    },
    "meta": {
        "include": [],
        "custom": {
            "payer_wallet": {
                "data": {
                    "object": "Wallet",
                    "id": "ml0wd39bxx5pkzna",
                    "name": "کیف پول پیش فرض",
                    "raw_balance": 990000,
                    "locked_balance": 0,
                    "balance": 990000,
                    "transfer_limit": 1000000,
                    "default": true,
                    "j_created_at": "۱۳۹۹/۰۲/۳۰ ۱:۲۹:۲۸",
                    "created_at": "2020-05-19 01:29:28",
                    "updated_at": "2020-05-19 23:22:21"
                }
            }
        }
    },
    "message": "everything's ok",
    "code": 0
}
 */

/** @var Route $router */
$router->post('wallets', [
    'as' => 'api_wallet_create_wallet',
    'uses'  => 'Controller@createWallet',
    'middleware' => [
      'auth:api',
    ],
]);
