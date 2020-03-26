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
{
    "data": {
    "object": "User",
        "id": "qnwmkv5704blag6r",
        "type": "PERSONAL",
        "gender": "MALE",
        "first_name": "fname",
        "last_name": "lname",
        "tel": "02188276525",
        "mobile": "09123236908",
        "email": "foo@bar.com",
        "address": "karaj - bahar st",
        "zip": "1234567892",
        "avatar": "https://www.gravatar.com/avatar/f3ada405ce890b6f8204094deb12d8a8.jpg?s=256&d=mm&r=g",
        "national_id": 3801245144,
        "company": null,
        "financial_is": null,
        "group": "NORMAL",
        "locked": false,
        "lock_reason": null,
        "idproofs": {
        "mobile": {
            "value": "09123236908",
                "status": 1
            },
            "email": {
            "value": "foo@bar.com",
                "status": 0
            },
            "tel": {
            "value": "02188276525",
                "status": 0
            },
            "residency": {
            "value": null,
                "status": 0
            },
            "identity": {
            "value": null,
                "status": 0
            },
            "company": {
            "value": null,
                "status": 0
            }
        },
        "meta": {
        "telegram_id": "a6oozar"
        },
        "birth_date": "1981-09-21",
        "created_at": "2020-03-26T20:08:00.000000Z",
        "updated_at": "2020-03-26T22:25:50.000000Z",
        "j_birth_date": "1360/06/30",
        "j_created_at": "1399/01/08",
        "readable_created_at": "2 hours ago",
        "readable_updated_at": "35 minutes ago"
    },
    "meta": {
    "include": [
        "roles"
    ],
        "custom": []
    },
    "message": "everything's ok",
    "api_code": 0
}

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
