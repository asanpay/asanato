<?php

/**
 * @apiGroup           Profile
 * @apiName            deleteProfile
 *
 * @api                {DELETE} /v1/profiles/:id deleteProfile
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
$router->delete('profiles/{id}', [
    'as' => 'api_profile_delete_profile',
    'uses'  => 'Controller@deleteProfile',
    'middleware' => [
      'auth:api',
    ],
]);
