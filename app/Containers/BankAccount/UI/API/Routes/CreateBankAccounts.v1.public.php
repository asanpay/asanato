<?php

/**
 * @apiGroup           BankAccount
 * @apiName            createBankAccount
 *
 * @api                {POST} /v1/bank-accounts Create BankAccount
 * @apiDescription     Create Bank
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {int}  iban IBAN (Sheba number) of the user only 24 digits without IR
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 201 OK
{
    "data": {
        "object": "BankAccount",
        "id": "ao6grd4ed38kyeqz",
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
