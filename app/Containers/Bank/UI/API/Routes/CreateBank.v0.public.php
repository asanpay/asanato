<?php

/**
 * @apiGroup           Bank
 * @apiName            createBank
 *
 * @api                {POST} /v0/banks Endpoint title here..
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
$router->post('banks', [
    'as' => 'api_bank_create_bank',
    'uses'  => 'Controller@createBank',
    'middleware' => [
      'auth:api',
    ],
]);
