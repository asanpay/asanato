<?php

/**
 * @apiGroup           Transfer
 * @apiName            TransferToOtherUser
 *
 * @api                {POST} /v1/transfer/others TransferToOtherUser
 * @apiDescription     Transfer to other user
 *
 * @apiVersion         1.0.0
 *
 * @apiParam           {String}  src_wallet_id source wallet id
 * @apiParam           {String}  dst_user_id destination user id
 * @apiParam           {Int}     amount Transfer amount in Rial
 * @apiParam           {String}  description (optional) transaction description
 * @apiParam           {string}  token OTP token
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
$router->post('transfer/others', [
    'as' => 'api_transfer_to_other_user',
    'uses'  => 'Controller@transferToOtherUser',
    'middleware' => [
      'auth:api',
    ],
]);
