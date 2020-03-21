<?php

/**
 * @apiGroup           Helpdesk
 * @apiName            getAllHelpdesks
 *
 * @api                {GET} /v1/helpdesks Endpoint title here..
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
$router->get('helpdesks', [
    'as' => 'api_helpdesk_get_all_helpdesks',
    'uses'  => 'Controller@getAllHelpdesks',
    'middleware' => [
      'auth:api',
    ],
]);
