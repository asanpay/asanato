<?php

/**
 * @apiGroup           Tx
 * @apiName            updateTx
 *
 * @api                {PATCH} /v1/tx/:id Update Tx
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      update-txes
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
$router->patch('tx/{id}', [
    'as' => 'api_tx_update_tx',
    'uses'  => 'Controller@updateTx',
    'middleware' => [
      'auth:api',
    ],
]);
