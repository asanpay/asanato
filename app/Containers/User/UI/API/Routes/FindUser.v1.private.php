<?php

/**
 * @apiGroup           Users
 * @apiName            findUserById
 * @api                {get} /v1/users/:id Find User
 * @apiDescription     Find a user by its ID
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 * @apiParam           {String}  keyword users mobile or email
 *
 * @apiUse             UserSuccessSingleResponse
 */

$router->get('users/find', [
    'as' => 'api_user_find_user',
    'uses'       => 'Controller@findUser',
    'middleware' => [
        'auth:api',
    ],
]);
