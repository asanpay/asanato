<?php

/**
 * @apiGroup Security
 * @apiName  getTempQrCode
 *
 * @api            {GET} /v1/security/temp-google-auth get Temporary Google Authenticator Qr Code
 * @apiDescription Get user account temporary Qr Code for Google Authenticator
 *
 * @apiVersion    1.0.0
 * @apiPermission Authenticated User
 *
 *
{
    "data": {
        "secret": "IFIAZGMN5O5AF72LKPEOUGIZP5W25X2K",
        "qr_code": "data:image/png;base64,iVBORw0KGgoAAAA........yQOXGygAAAABJRU5ErkJggg=="
    },
    "message": "everything's ok",
    "code": 0,
    "xTrackId": "04a1c9d094"
}
 */

$router->get(
    'security/temp-google-auth',
    [
        'as'         => 'api_temp_user_get_qr_code',
        'uses'       => 'Controller@getTempGoogleAuth',
        'middleware' => [
            'auth:api',
        ],
    ]
);
