<?php

/**
 * @apiGroup           Withdrawal
 * @apiName            deleteWithdrawal
 *
 * @api                {DELETE} /v1/withdrawals/:id Endpoint title here..
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
$router->delete('withdrawals/{id}', [
    'as' => 'api_withdrawal_delete_withdrawal',
    'uses'  => 'Controller@deleteWithdrawal',
    'middleware' => [
      'auth:api',
    ],
]);
