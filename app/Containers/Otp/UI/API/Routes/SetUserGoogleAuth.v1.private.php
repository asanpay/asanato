<?php

/**
 * @apiGroup           Security
 * @apiName            SetUserGoogleAuth
 *
 * @api                {post} /v1/security/google-auth Enable Google Auth Key for user
 * @apiDescription     Enable Google Authentication for current user
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 *
 */
$router->post('security/google-auth', [
    'as' => 'api_authorization_enable_google_auth_for_user',
    'uses'       => 'Controller@setUserGoogleAuth',
    'middleware' => [
        'auth:api',
    ],
]);
