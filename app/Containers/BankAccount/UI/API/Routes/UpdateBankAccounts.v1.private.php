<?php

/**
 * @apiGroup           BankAccount
 * @apiName            updateBankAccount
 *
 * @api                {DELETE} /v1/users/{user_id}/bank-accounts/:id Update Bank Account
 * @apiDescription     Update User BankAccount
 *
 * @apiVersion         1.0.0
 * @apiPermission      delete-bank-accounts
 *
 * @apiParam           {int}  iban IBAN (Sheba number) of the user only 24 digits without IR
 * @apiParam           {int}  iban IBAN (Sheba number) of the user only 24 digits without IR
 *
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 204 No Content
 */

/** @var Route $router */
$router->patch('users/{user_id}/bank-accounts/{id}', [
    'as' => 'api_bank_update_bank_account',
    'uses'  => 'Controller@updateBankAccount',
    'middleware' => [
      'auth:api',
    ],
]);
