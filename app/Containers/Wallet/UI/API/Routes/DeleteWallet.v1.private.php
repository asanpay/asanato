<?php

/**
 * @apiGroup           Wallet
 * @apiName            deleteWallet
 *
 * @api                {DELETE} /v1/wallets/:id deleteWallet
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
$router->delete('wallets/{id}', [
    'as' => 'api_wallet_delete_wallet',
    'uses'  => 'Controller@deleteWallet',
    'middleware' => [
      'auth:api',
    ],
]);
