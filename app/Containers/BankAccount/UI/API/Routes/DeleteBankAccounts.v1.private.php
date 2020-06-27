<?php

/**
 * @apiGroup           BankAccount
 * @apiName            deleteBankAccount
 *
 * @api                {DELETE} /v1/users/{user_id}/bank-accounts/:id Delete Bank Account
 * @apiDescription     Delete User BankAccount
 *
 * @apiVersion         1.0.0
 * @apiPermission      delete-bank-accounts
 *
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 204 No Content
 */

/** @var Route $router */
$router->delete('users/{user_id}/bank-accounts/{id}', [
    'as' => 'api_bank_delete_bank_account',
    'uses'  => 'Controller@deleteBankAccount',
    'middleware' => [
      'auth:api',
    ],
]);
