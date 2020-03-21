<?php

/**
 * @apiGroup           Wallet
 * @apiName            getAllWallets
 *
 * @api                {GET} /v1/wallets Endpoint title here..
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
$router->get('wallets', [
    'as' => 'api_wallet_get_all_wallets',
    'uses'  => 'Controller@getAllWallets',
    'middleware' => [
      'auth:api',
    ],
]);
