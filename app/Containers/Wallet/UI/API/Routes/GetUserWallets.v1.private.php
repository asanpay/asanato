<?php

/**
 * @apiGroup           Wallet
 * @apiName            GetUserWallets
 *
 * @api                {GET} /v1/users/{id}/wallets GetUserWallets
 * @apiDescription     Get all user wallets
 *
 * @apiVersion         1.0.0
 * @apiPermission      read-wallet
 *
 * @apiParam           {String} id hashed user id
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

/** @var Route $router */
$router->get('users/{id}/wallets', [
    'as' => 'api_wallet_get_user_wallets',
    'uses'  => 'Controller@getUserWallets',
    'middleware' => [
      'auth:api',
    ],
]);
