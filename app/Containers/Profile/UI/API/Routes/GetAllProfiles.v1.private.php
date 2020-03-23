<?php

/**
 * @apiGroup           Profile
 * @apiName            getAllProfiles
 *
 * @api                {GET} /v1/profiles getAllProfiles
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
$router->get('profiles', [
    'as' => 'api_profile_get_all_profiles',
    'uses'  => 'Controller@getAllProfiles',
    'middleware' => [
      'auth:api',
    ],
]);
