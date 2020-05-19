<?php

/**
 * @apiGroup           Wallet
 * @apiName            updateWallet
 *
 * @api                {PATCH} /v1/wallets/:id updateWallet
 * @apiDescription     Update wallet information
 *
 * @apiVersion         1.0.0
 * @apiPermission      read-wallet
 *
 * @apiParam           {String}  parameters here..
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
