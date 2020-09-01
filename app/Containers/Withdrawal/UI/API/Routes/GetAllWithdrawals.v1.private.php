<?php

/**
 * @apiGroup           Withdrawal
 * @apiName            getAllWithdrawals
 *
 * @api                {GET} /v1/withdrawals Endpoint title here..
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
$router->get('withdrawals', [
    'as' => 'api_withdrawal_get_all_withdrawals',
    'uses'  => 'Controller@getAllWithdrawals',
    'middleware' => [
      'auth:api',
    ],
]);
