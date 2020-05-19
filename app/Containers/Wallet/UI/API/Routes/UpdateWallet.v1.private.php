<?php

/**
 * @apiGroup           Wallet
 * @apiName            UpdateWallet
 *
 * @api                {PATCH} /v1/wallets/:id UpdateWallet
 * @apiDescription     Update wallet data
 *
 * @apiVersion         1.0.0
 * @apiPermission      update-wallet
 *
 * @apiParam           {String} id  hashed wallet id
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

/** @var Route $router */
$router->patch('wallets/{id}', [
    'as' => 'api_wallet_update_wallet',
    'uses'  => 'Controller@updateWallet',
    'middleware' => [
      'auth:api',
    ],
]);
