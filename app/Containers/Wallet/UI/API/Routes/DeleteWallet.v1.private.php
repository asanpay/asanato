<?php

/**
 * @apiGroup           Wallet
 * @apiName            DeleteWallet
 *
 * @api                {DELETE} /v1/wallets/:id deleteWallet
 * @apiDescription     Delete a non-default Wallet
 *
 * @apiVersion         1.0.0
 * @apiPermission      delete-wallets
 *
 * @apiParam           {String}  id Encrypted wallet ID
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 204 OK
 */

/** @var Route $router */
$router->delete('wallets/{id}', [
    'as' => 'api_wallet_delete_wallet',
    'uses'  => 'Controller@deleteWallet',
    'middleware' => [
      'auth:api',
    ],
]);
