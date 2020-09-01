<?php

/**
 * @apiGroup           Withdrawal
 * @apiName            createWithdrawal
 *
 * @api                {POST} /v1/withdrawals Create Withdrawal
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
$router->post('withdrawals', [
    'as' => 'api_withdrawal_create_withdrawal',
    'uses'  => 'Controller@createWithdrawal',
    'middleware' => [
      'auth:api',
    ],
]);
