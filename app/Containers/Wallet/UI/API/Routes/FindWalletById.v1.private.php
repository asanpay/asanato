<?php

/**
 * @apiGroup           Wallet
 * @apiName            findWalletById
 *
 * @api                {GET} /v1/wallets/:id findWalletById
 * @apiDescription     Create USER wallet
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  id
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
    "data": {
    "object": "Wallet",
        "id": "o6grd4eb7x48kyeq",
        "name": "foo",
        "raw_balance": 0,
        "locked_balance": 0,
        "balance": 0,
        "transfer_limit": 1000000,
        "default": false,
        "j_created_at": "۱۳۹۹/۰۲/۱۹ ۱۹:۲۴:۵",
        "created_at": "2020-05-08T14:54:05.000000Z",
        "updated_at": "2020-05-08T14:54:05.000000Z"
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
$router->get('wallets/{id}', [
    'as' => 'api_wallet_find_wallet_by_id',
    'uses'  => 'Controller@findWalletById',
    'middleware' => [
      'auth:api',
    ],
]);
