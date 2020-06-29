<?php

/**
 * @apiGroup           BankAccount
 * @apiName            createBankAccount
 *
 * @api                {POST} /v1/bank-accounts Create BankAccount
 * @apiDescription     Create Bank Account
 *
 * @apiVersion         1.0.0
 * @apiPermission      create-bank-accounts
 *
 * @apiParam           {int}  iban IBAN (Sheba number) of the user only 24 digits without IR
 * @apiParam           {string}  user_id (optional) only if logged in user has access to create bank account for other users
 * @apiParam           {string}  bank_id (optional) the bank that account belongs to
 * @apiParam           {boolean}  default (optional) made default the created account
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 201 OK
{
    "data": {
        "object": "BankAccount",
        "id": "ao6grd4ed38kyeqz",
        "user_id": "ao6grd4ed38kyeqz",
        "iban": "123456789012345678901234",
        "sheba": "IR123456789012345678901234",
        "status": "PENDING",
        "created_at": "2020-06-16 20:27:12",
        "updated_at": "2020-06-16 20:27:12"
    },
    "meta": {
        "include": [],
        "custom": []
    },
    "message": "everything's ok",
    "code": 0,
    "xTrackId": "60936af678"
}
 */

/** @var Route $router */
$router->post('bank-accounts', [
    'as' => 'api_bank_create_bank_accounts',
    'uses'  => 'Controller@createBankAccount',
    'middleware' => [
      'auth:api',
    ],
]);
