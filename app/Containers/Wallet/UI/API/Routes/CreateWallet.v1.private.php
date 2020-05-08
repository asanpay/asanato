<?php

/**
 * @apiGroup           Wallet
 * @apiName            createWallet
 *
 * @api                {POST} /v1/wallets createWallet
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  name
 * @apiParam           {Boolean}  default
 * @apiParam           {String}  payer_wallet_id
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
        "custom": []
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
