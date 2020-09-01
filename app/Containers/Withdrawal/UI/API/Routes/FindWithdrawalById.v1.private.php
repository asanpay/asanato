<?php

/**
 * @apiGroup           Withdrawal
 * @apiName            findWithdrawalById
 *
 * @api                {GET} /v1/withdrawals/:id Endpoint title here..
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
$router->get('withdrawals/{id}', [
    'as' => 'api_withdrawal_find_withdrawal_by_id',
    'uses'  => 'Controller@findWithdrawalById',
    'middleware' => [
      'auth:api',
    ],
]);
