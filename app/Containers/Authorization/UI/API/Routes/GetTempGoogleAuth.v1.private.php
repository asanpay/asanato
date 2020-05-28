<?php

/**
 * @apiGroup           Security
 * @apiName            getAuthQrCode
 *
 * @api                {GET} /v1/security/temp-google-auth get Google Authenticator Qr Code
 * @apiDescription     Get user account Qr Code for Google Authenticator
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 *
{
    "data": {
        "secret": "IFIAZGMN5O5AF72LKPEOUGIZP5W25X2K",
        "qr_code": "data:image/png;base64,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"
    },
    "message": "everything's ok",
    "code": 0,
    "xTrackId": "04a1c9d094"
}
*/

$router->get('security/temp-google-auth', [
    'as' => 'api_temp_user_get_qr_code',
    'uses'  => 'Controller@getTempGoogleAuth',
    'middleware' => [
      'auth:api',
    ],
]);