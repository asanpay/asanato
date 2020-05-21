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

}
 */

/** @var Route $router */
$router->post('transfer/transfer-between-my-wallets', [
    'as' => 'api_transfer_between_my_wallets',
    'uses'  => 'Controller@transferBetweenMyWallets',
    'middleware' => [
      'auth:api',
    ],
]);
