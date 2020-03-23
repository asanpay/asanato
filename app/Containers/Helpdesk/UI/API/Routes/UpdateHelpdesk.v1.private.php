<?php

/**
 * @apiGroup           Helpdesk
 * @apiName            updateHelpdesk
 *
 * @api                {PATCH} /v1/helpdesks/:id updateHelpdesk
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
$router->patch('helpdesks/{id}', [
    'as' => 'api_helpdesk_update_helpdesk',
    'uses'  => 'Controller@updateHelpdesk',
    'middleware' => [
      'auth:api',
    ],
]);
