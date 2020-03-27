<?php

/**
 * @apiGroup           Otp
 * @apiName            send OTP token
 * @api                {post} /v1/otp send token
 * @apiDescription     send  OTP token to user mobile/email/app/...
 *
 * @apiVersion         1.0.0
 *
 * @apiParam           {string} reason The reason of otp token signup,transfer-money,mobile-verify,reset-pass,mobile-verify,...
 * @apiParam           {string} mobile mobile number of the user
 * @apiParam           {string} email email address of the user
 *
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
