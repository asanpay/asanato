<?php

/**
 * @apiGroup           Transfer
 * @apiName            TransferBetweenMyWallets
 *
 * @api                {POST} /v1/transfer/my-wallets TransferBetweenMyWallets
 * @apiDescription     Transfer Between My Wallets
 *
 * @apiVersion         1.0.0
 *
 * @apiParam           {String}  src_wallet_id source wallet id
 * @apiParam           {String}  dst_wallet_id destination wallet id
 * @apiParam           {Int}  amount Transfer amount in Rial
 * @apiParam           {String}  description (optional) transaction description
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
    "data": {
        "object": "Tx",
        "id": "l0865ybvrk73bgme",
        "client_ip": "127.0.0.1",
        "j_created_at": 13990301194349,
        "created_at": "2020-05-21 19:43:49",
        "tracking_id": 201416400001
    },
    "meta": {
        "include": [],
        "custom": []
    },
    "message": "everything's ok",
    "code": 0,
    "xTrackId": "8f03b26aef"
}
 */

/** @var Route $router */
$router->post('transfer/my-wallets', [
    'as' => 'api_transfer_between_my_wallets',
    'uses'  => 'Controller@transferBetweenMyWallets',
    'middleware' => [
      'auth:api',
    ],
]);
