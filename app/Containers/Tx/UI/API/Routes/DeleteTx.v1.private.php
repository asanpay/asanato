<?php

/**
 * @apiGroup           Tx
 * @apiName            deleteTx
 *
 * @api                {DELETE} /v1/tx/:id Endpoint title here..
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
$router->delete('tx/{id}', [
    'as' => 'api_tx_delete_tx',
    'uses'  => 'Controller@deleteTx',
    'middleware' => [
      'auth:api',
    ],
]);
