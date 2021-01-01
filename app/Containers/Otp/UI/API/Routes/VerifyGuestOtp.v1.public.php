<?php

/**
 * @apiGroup       Otp
 * @apiName        verify guests OTP token
 * @api            {patch} /v1/guest-otp verify guest token
 * @apiDescription verify an OTP token when user is not defined as a logged in user
 *
 * @apiVersion 1.0.0
 *
 * @apiParam {string} reason The reason of otp token signup,mobile-verify,reset-pass,...
 * @apiParam {string} mobile user mobile
 * @apiParam {string} email user email
 * @apiParam {string} token token
 *
 * @apiSuccessExample {json}       Success-Response:
 * HTTP/1.1 204 OK
 * {
 * }
 */

$router->patch(
    'guest-otp',
    [
        'as'   => 'api_autz_confirm_guest_otp',
        'uses' => 'Controller@verifyGuestOtpToken',
    ]
);
