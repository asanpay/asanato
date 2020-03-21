<?php

/**
 * @apiGroup           Helpdesk
 * @apiName            deleteHelpdesk
 *
 * @api                {DELETE} /v1/helpdesks/:id Endpoint title here..
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
$router->delete('helpdesks/{id}', [
    'as' => 'api_helpdesk_delete_helpdesk',
    'uses'  => 'Controller@deleteHelpdesk',
    'middleware' => [
      'auth:api',
    ],
]);
