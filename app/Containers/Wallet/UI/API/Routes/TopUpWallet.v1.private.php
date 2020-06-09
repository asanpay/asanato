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
 * @apiParam           {String}  callback_url callback url (option)
 * @apiParam           {boolean}  is_mobile_app if your are using mobile app or not
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
 *
 */

/** @var Route $router */
$router->post('wallet-topup', [
    'as' => 'api_wallet_topup_wallet',
    'uses'  => 'Controller@topUpWallet',
    'middleware' => [
      'auth:api',
    ],
]);
