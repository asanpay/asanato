<?php

/**
 * @apiGroup           Wallet
 * @apiName            GetAllWallets
 *
 * @api                {GET} /v1/wallets GetAllWallets
 * @apiDescription     Get all wallets
 *
 * @apiVersion         1.0.0
 * @apiPermission      read-wallets
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
    "data": [
        {
            "object": "Wallet",
            "id": "nwmkv57dmz5blag6",
            "user_id": "qmv7dk48x5b690wx",
            "name": "WALLET_B",
            "raw_balance": 100000,
            "locked_balance": 0,
            "balance": 100000,
            "transfer_limit": 1000000,
            "default": false,
            "j_created_at": "۱۳۹۹/۰۴/۰۳ ۱:۵۳:۱۴",
            "created_at": "2020-06-23 01:53:14",
            "updated_at": "2020-06-23 01:53:14"
        },
        {
            "object": "Wallet",
            "id": "ml0wd39bxx5pkzna",
            "user_id": "qmv7dk48x5b690wx",
            "name": "WALLET_LOCKED_BAL",
            "raw_balance": 1500000,
            "locked_balance": 1000000,
            "balance": 500000,
            "transfer_limit": 1000000,
            "default": false,
            "j_created_at": "۱۳۹۹/۰۴/۰۳ ۱:۵۳:۱۴",
            "created_at": "2020-06-23 01:53:14",
            "updated_at": "2020-06-23 01:53:14"
        },
        {
            "object": "Wallet",
            "id": "mv7dk48nmd4b690w",
            "user_id": "qmv7dk48x5b690wx",
            "name": "GHOLI",
            "raw_balance": 5000000,
            "locked_balance": 0,
            "balance": 5000000,
            "transfer_limit": 1000000,
            "default": false,
            "j_created_at": "۱۳۹۹/۰۴/۰۳ ۱:۵۳:۱۴",
            "created_at": "2020-06-23 01:53:14",
            "updated_at": "2020-06-29 19:06:44"
        },
        {
            "object": "Wallet",
            "id": "vmg6q36wmk5b8kzr",
            "user_id": "qmv7dk48x5b690wx",
            "name": "GHOLI2000",
            "raw_balance": 10000000,
            "locked_balance": 0,
            "balance": 10000000,
            "transfer_limit": 1000000,
            "default": true,
            "j_created_at": "۱۳۹۹/۰۴/۰۳ ۱:۵۳:۱۴",
            "created_at": "2020-06-23 01:53:14",
            "updated_at": "2020-06-29 19:09:49"
        }
    ],
        "meta": {
            "include": [],
            "custom": [],
            "pagination": {
            "total": 4,
            "count": 4,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": {}
        }
    },
    "message": "everything's ok",
    "code": 0,
    "xTrackId": "deddd40007"
}
 */

/** @var Route $router */
$router->get('wallets', [
    'as' => 'api_wallet_get_all_wallets',
    'uses'  => 'Controller@getAllWallets',
    'middleware' => [
      'auth:api',
    ],
]);
