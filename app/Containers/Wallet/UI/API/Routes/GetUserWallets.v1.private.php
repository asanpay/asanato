<?php

/**
 * @apiGroup           Wallet
 * @apiName            getUserWallets
 *
 * @api                {GET} /v1/users/{id}/wallets getUserWallets
 * @apiDescription     Get all user wallets
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
$router->get('users/{id}/wallets', [
    'as' => 'api_wallet_get_user_wallets',
    'uses'  => 'Controller@getUserWallets',
    'middleware' => [
      'auth:api',
    ],
]);
