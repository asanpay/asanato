<?php

/**
 * @apiGroup           BankAccount
 * @apiName            FindBankAccountsById
 *
 * @api                {GET} /v1/users/{user_id}/bank-accounts/{id} FindBankAccountsById
 * @apiDescription     Find user bank accounts by id
 *
 * @apiVersion         1.0.0
 * @apiPermission      read-bank-accounts
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
    "data": {
        "object": "BankAccount",
        "id": "8ykwxd4gx3ampj9v",
        "user_id": "qmv7dk48x5b690wx",
        "iban": "123456789012345678901234",
        "sheba": "IR123456789012345678901234",
        "status": "PENDING",
        "created_at": "2020-06-29 11:25:42",
        "updated_at": "2020-06-29 11:25:42"
    },
    "meta": {
        "include": [],
        "custom": []
    },
    "message": "everything's ok",
    "code": 0,
    "xTrackId": "861adbb3f4"
}
 */

/** @var Route $router */
$router->get('users/{user_id}/bank-accounts/{id}', [
    'as' => 'api_bank_find_a_bank_account',
    'uses'  => 'Controller@findUserAccountById',
    'middleware' => [
      'auth:api',
    ],
]);
