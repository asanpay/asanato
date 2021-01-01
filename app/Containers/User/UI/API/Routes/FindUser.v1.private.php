<?php

/**
 * @apiGroup       Users
 * @apiName        findUserByMobileOrEmail
 * @api            {get} /v1/users/find Find User by Email/Mobile
 * @apiDescription Find a user by his/her mobile or email
 *
 * @apiVersion    1.0.0
 * @apiPermission Authenticated User
 * @apiParam      {String}  keyword users mobile or email
 *
 * @apiUse UserSuccessSingleResponse
 */

$router->get(
    'users/find',
    [
        'as' => 'api_user_find_user',
        'uses'       => 'Controller@findUser',
        'middleware' => [
            'auth:api',
        ],
    ]
);
