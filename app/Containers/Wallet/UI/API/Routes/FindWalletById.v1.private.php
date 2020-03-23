<?php

/**
 * @apiGroup           Wallet
 * @apiName            findWalletById
 *
 * @api                {GET} /v1/wallets/:id findWalletById
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
$router->get('wallets/{id}', [
    'as' => 'api_wallet_find_wallet_by_id',
    'uses'  => 'Controller@findWalletById',
    'middleware' => [
      'auth:api',
    ],
]);
