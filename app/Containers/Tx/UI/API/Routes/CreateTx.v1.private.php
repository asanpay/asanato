<?php

/**
 * @apiGroup           Tx
 * @apiName            createTx
 *
 * @api                {POST} /v1/tx Endpoint title here..
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
$router->post('tx', [
    'as' => 'api_tx_create_tx',
    'uses'  => 'Controller@createTx',
    'middleware' => [
      'auth:api',
    ],
]);
