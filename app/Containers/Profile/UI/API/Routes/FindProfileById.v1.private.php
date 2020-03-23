<?php

/**
 * @apiGroup           Profile
 * @apiName            findProfileById
 *
 * @api                {GET} /v1/profiles/:id findProfileById
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
$router->get('profiles/{id}', [
    'as' => 'api_profile_find_profile_by_id',
    'uses'  => 'Controller@findProfileById',
    'middleware' => [
      'auth:api',
    ],
]);
