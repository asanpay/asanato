<?php

/**
 * @apiGroup           Wallet
 * @apiName            GetAllWallets
 *
 * @api                {GET} /v1/wallets GetAllWallets
 * @apiDescription     Get all wallets
 *
 * @apiVersion         1.0.0
 * @apiPermission      read-wallets
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
