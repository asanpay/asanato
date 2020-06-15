<?php

/**
 * @apiGroup           Wallet
 * @apiName            TopUpWallet
 *
 * @api                {POST} /v1/wallet-topup TopUpWallet
 * @apiDescription     Top Up a wallet
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated user
 *
 * @apiParam           {int}     amount Top Up amount
 * @apiParam           {String}  wallet_id wallet id
 * @apiParam           {String}  description transaction description (optional)
 * @apiParam           {String}  callback_url callback url (optional)
 * @apiParam           {boolean}  is_mobile_app if your are using mobile app or not (optional)
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
    "code": 0,
    "token": "APUY-1000007",
    "date": "2020-06-14 20:37:25",
    "jalali_date": "1399/03/25 20:37:25",
    "x_track_id": "3d1c49967e",
    "gate_url": "https://ipg.asanpay.yhn/gate/APUY-1000007",
    "message": "everything's ok",
    "xTrackId": "3d1c49967e"
}
 */

/** @var Route $router */
$router->post('wallet-topup', [
    'as' => 'api_wallet_topup_wallet',
    'uses'  => 'Controller@topUpWallet',
    'middleware' => [
      'auth:api',
    ],
]);
