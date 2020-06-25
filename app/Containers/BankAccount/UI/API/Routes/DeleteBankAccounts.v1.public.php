<?php

/**
 * @apiGroup           BankAccount
 * @apiName            deleteBankAccount
 *
 * @api                {DELETE} /v1/bank-accounts/:id Delete Bank Account
 * @apiDescription     Delete BankAccount
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 204 No Content
 */

/** @var Route $router */
$router->delete('bank-accounts/{id}', [
    'as' => 'api_bank_delete_bank_account',
    'uses'  => 'Controller@deleteBankAccount',
    'middleware' => [
      'auth:api',
    ],
]);
