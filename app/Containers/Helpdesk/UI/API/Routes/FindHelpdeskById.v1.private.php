<?php

/**
 * @apiGroup           Helpdesk
 * @apiName            findHelpdeskById
 *
 * @api                {GET} /v1/helpdesks/:id Endpoint title here..
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
$router->get('helpdesks/{id}', [
    'as' => 'api_helpdesk_find_helpdesk_by_id',
    'uses'  => 'Controller@findHelpdeskById',
    'middleware' => [
      'auth:api',
    ],
]);
