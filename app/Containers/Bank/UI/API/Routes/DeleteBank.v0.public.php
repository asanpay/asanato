<?php

/**
 * @apiGroup           Bank
 * @apiName            deleteBank
 *
 * @api                {DELETE} /v0/banks/:id Endpoint title here..
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         0.0.0
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
$router->delete('banks/{id}', [
    'as' => 'api_bank_delete_bank',
    'uses'  => 'Controller@deleteBank',
    'middleware' => [
      'auth:api',
    ],
]);
