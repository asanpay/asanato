<?php

/**
 * @apiGroup           Users
 * @apiName            findUserByMobileOrEmail
 * @api                {get} /v1/users/find Find User by Email/Mobile
 * @apiDescription     Find a user by his/her mobile or email
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiParam           {String}  keyword users mobile or email
 *
 * @apiSuccessExample  {json}       Success-Response:
 *   HTTP/1.1 200 OK
{
    "data": {
    "object": "User",
        "id": "qmv7dk48x5b690wx",
        "name": "کاربر آسان پی",
        "email": "user@asanpay.com",
        "mobile": "09354885725",
        "avatar": "https://www.gravatar.com/avatar/50ef8d1422a08fa19c4c5c76da7d0577.jpg?s=128&d=mm&r=g"
    },
    "meta": {
    "include": [
        "roles"
    ],
        "custom": []
    },
    "message": "everything's ok",
    "code": 0,
    "xTrackId": "615fabda74"
}
 */

$router->get('users/find', [
    'as' => 'api_user_find_user',
    'uses'       => 'Controller@findUser',
    'middleware' => [
        'auth:api',
    ],
]);
