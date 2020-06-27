<?php

/**
 * @apiGroup           Wallet
 * @apiName            GetUserWallets
 *
 * @api                {GET} /v1/users/{id}/wallets GetUserWallets
 * @apiDescription     Get all user wallets
 *
 * @apiVersion         1.0.0
 * @apiPermission      read-wallets
 *
 * @apiParam           {String} id hashed user id
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
    "data": [
            {
                "object": "Wallet",
                "id": "ml0wm39bxx5pkzna",
                "name": "کیف پول پیش فرض",
                "raw_balance": 0,
                "locked_balance": 0,
                "balance": 0,
                "transfer_limit": 1000000,
                "default": true,
                "j_created_at": "۱۳۹۹/۰۲/۳۰ ۱:۲۹:۲۸",
                "created_at": "2020-05-19 01:29:28",
                "updated_at": "2020-05-19 23:22:21"
            }
    ],
    "meta": {
        "include": [],
        "custom": [],
        "pagination": {
            "total": 1,
            "count": 1,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": {}
        }
    },
    "message": "everything's ok",
    "code": 0
}
 */

/** @var Route $router */
$router->get('users/{id}/wallets', [
    'as' => 'api_wallet_get_user_wallets',
    'uses'  => 'Controller@getUserWallets',
    'middleware' => [
      'auth:api',
    ],
]);
