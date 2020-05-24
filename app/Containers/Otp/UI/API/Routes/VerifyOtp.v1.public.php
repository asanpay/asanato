<?php

/**
 * @apiGroup           Otp
 * @apiName            verify OTP token
 * @api                {patch} /v1/otp verify token
 * @apiDescription     verify a OTP token
 *
 * @apiVersion         1.0.0
 *
 * @apiParam           {string} reason The reason of otp token signup,transfer-money,mobile-verify,reset-pass,mobile-verify,...
 * @apiParam           {string} value value of the reason that should confirm like user email/mobile/...
 * @apiParam           {string} token token
 *
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
"message": "token has been sent successfully",
}
 */

$router->patch('otp', [
    'as' => 'api_autz_confirm_otp',
    'uses'       => 'Controller@verifyOtpToken',
]);
