<?php

/**
 * @apiGroup           Wallet
 * @apiName            createWallet
 *
 * @api                {POST} /v1/wallets createWallet
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
$router->post('wallets', [
    'as' => 'api_wallet_create_wallet',
    'uses'  => 'Controller@createWallet',
    'middleware' => [
      'auth:api',
    ],
]);
