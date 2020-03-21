<?php

/**
 * @apiGroup           Transaction
 * @apiName            findTransactionById
 *
 * @api                {GET} /v1/transactions/:id Endpoint title here..
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
$router->get('transactions/{id}', [
    'as' => 'api_transaction_find_transaction_by_id',
    'uses'  => 'Controller@findTransactionById',
    'middleware' => [
      'auth:api',
    ],
]);
