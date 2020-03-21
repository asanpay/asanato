<?php

/**
 * @apiGroup           Profile
 * @apiName            createProfile
 *
 * @api                {POST} /v1/profiles Endpoint title here..
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
$router->post('profiles', [
    'as' => 'api_profile_create_profile',
    'uses'  => 'Controller@createProfile',
    'middleware' => [
      'auth:api',
    ],
]);
