<?php

/**
 * @apiGroup           Otp
 * @apiName            send OTP token to user mobile/email/app/...
 * @api                {post} /v1/otp send ot token
 * @apiDescription
 *
 * @apiVersion         1.0.0
 *
 * @apiParam           {string} reason The reason of otp token signup,transfer-money,mobile-verify,reset-pass... (see authorization-config.php)
 * @apiParam           {string} mobile mobile number of the user
 * @apiParam           {string} email email address of the user
 *
 * @apiUse             UserAuthorization
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
    "message": "token has been sent successfully",
}
 */

$router->post('otp', [
    'as'   => 'api_autz_send_otp',
    'uses' => 'Controller@sendOtpToken',
]);
