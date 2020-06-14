<?php

/**
 * @apiGroup           Tx
 * @apiName            getAllTxes
 *
 * @api                {GET} /v1/tx Endpoint title here..
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
$router->get('tx', [
    'as' => 'api_tx_get_all_txes',
    'uses'  => 'Controller@getAllTxes',
    'middleware' => [
      'auth:api',
    ],
]);
