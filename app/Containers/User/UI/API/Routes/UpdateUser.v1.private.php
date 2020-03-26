<?php
/**
 * @apiGroup           Users
 * @apiName            updateUser
 * @api                {put} /v1/users/:id Update User Profile
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiParam           {String}  type user type PERSONAL,LEGAL
 * @apiParam           {String}  first_name first name
 * @apiParam           {String}  last_name last name
 * @apiParam           {String}  gender MALE,FEMALE,UNKNOWN
 * @apiParam           {int}  national_id user national ID
 * @apiParam           {String}  email email
 * @apiParam           {digits}  mobile mobile number
 * @apiParam           {date}  birth_date gregorian date 2020-09-21
 * @apiParam           {int}  zip user zip code (10 digits)
 * @apiParam           {String}  address user address
 * @apiParam           {digits}  tel user tel including area code like 02188776655
 *
 * @apiSuccessExample  {json}       Success-Response:
 *   HTTP/1.1 200 OK
 * {
 *     "data": {
 *         "object": "User",
 *         "id": "qnwmkv5704blag6r",
 *         "name": null,
 *         "email": "foo@bar.com",
 *         "confirmed": null,
 *         "nickname": null,
 *         "gender": "MALE",
 *         "birth": null,
 *         "social_auth_provider": null,
 *         "social_id": null,
 *         "social_avatar": {
 *             "avatar": null,
 *             "original": null
 *         },
 *         "created_at": "2020-03-26T20:08:00.000000Z",
 *         "updated_at": "2020-03-26T22:25:50.000000Z",
 *         "readable_created_at": "2 hours ago",
 *         "readable_updated_at": "28 minutes ago"
 *     },
 *     "meta": {
 *         "include": [
 *         "roles"
 *     ],
 *         "custom": []
 *     },
 *     "message": "everything's ok",
 *     "api_code": 0
 * }
 *
 * @apiErrorExample  {json}       Error-Response:
 *   {
 *      "message":"nok",
 *      "api_code":401
 *   }
 */

$router->put('users/{id}', [
    'as' => 'api_user_update_user',
    'uses'       => 'Controller@updateUser',
    'middleware' => [
        'auth:api',
    ],
]);
