<?php

/**
 * @apiGroup           Wallet
 * @apiName            updateWallet
 *
 * @api                {PATCH} /v1/wallets/:id updateWallet
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
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
