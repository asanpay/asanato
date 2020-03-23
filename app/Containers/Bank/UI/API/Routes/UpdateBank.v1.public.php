<?php

/**
 * @apiGroup           Bank
 * @apiName            updateBank
 *
 * @api                {PATCH} /v0/banks/:id Update Bank
 * @apiDescription     Update Bank
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
$router->patch('banks/{id}', [
    'as' => 'api_bank_update_bank',
    'uses'  => 'Controller@updateBank',
    'middleware' => [
      'auth:api',
    ],
]);
