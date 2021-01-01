<?php

/**
 * @apiGroup       Security
 * @apiName        getPermanentAuthQrCode
 *
 * @api            {GET} /v1/security/google-auth get Google Authenticator permanent Qr Code
 * @apiDescription Get user account permanent Qr Code for Google Authenticator
 *
 * @apiVersion     1.0.0
 * @apiPermission  Authenticated User
 *
 *
 * {
 * "data": {
 * "object": "User",
 * "id": "qmv7dk48x5b690wx",
 * "qr_code": "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAAD.....ORK5CYII="
 * },
 * "meta": {
 * "include": [],
 * "custom": []
 * },
 * "message": "everything's ok",
 * "code": 0,
 * "xTrackId": "e03894662d"
 * }
 */

$router->get(
    'security/google-auth',
    [
        'as'         => 'api_user_get_qr_code',
        'uses'       => 'Controller@getGoogleAuthQrCode',
        'middleware' => [
            'auth:api',
        ],
    ]
);
