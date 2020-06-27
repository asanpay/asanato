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
}Zkey
 */

/** @var Route $router */
$router->get('users/{user_id}/bank-accounts/{id}', [
    'as' => 'api_bank_get_all_bank_accounts',
    'uses'  => 'Controller@getAllBankAccounts',
    'middleware' => [
      'auth:api',
    ],
]);
