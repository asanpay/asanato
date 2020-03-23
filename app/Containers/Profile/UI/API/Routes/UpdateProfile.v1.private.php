<?php

/**
 * @apiGroup           Profile
 * @apiName            updateProfile
 *
 * @api                {PATCH} /v1/profiles/:id updateProfile
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
$router->patch('profiles/{id}', [
    'as' => 'api_profile_update_profile',
    'uses'  => 'Controller@updateProfile',
    'middleware' => [
      'auth:api',
    ],
]);
