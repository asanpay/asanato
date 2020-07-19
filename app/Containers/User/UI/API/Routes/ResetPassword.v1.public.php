<?php

/**
 * @apiGroup           User
 * @apiName            resetPassword
 *
 * @api                {PATCH} /v1/password/reset Reset Password
 * @apiDescription     Resets a password for an user.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  mobile
 * @apiParam           {String}  token from the forgot password email
 * @apiParam           {String}  password the new password
 * @apiParam           {String}  password_confirmation the new password confirmation
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 204 OK
{}
 */

$router->patch('password/reset', [
    'as' => 'api_user_reset_password',
    'uses'  => 'Controller@resetPassword',
]);
