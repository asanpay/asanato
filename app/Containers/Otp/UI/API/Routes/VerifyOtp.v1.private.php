<?php

/**
 * @apiGroup           Otp
 * @apiName            verify OTP token
 * @api                {patch} /v1/otp verify token
 * @apiDescription     verify an OTP token
 *
 * @apiVersion         1.0.0
 *
 * @apiParam           {string} token token
 *
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 204 OK
 * {
 * }
 */

$router->patch('otp', [
    'as'   => 'api_autz_confirm_otp',
    'uses' => 'Controller@verifyOtpToken',
    'middleware' => [
        'auth:api',
    ],
]);
