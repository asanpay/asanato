<?php

/**
 * @apiGroup           BankAccount
 * @apiName            getUserBankAccounts
 *
 * @api                {GET} /v1/users/{user_id}/bank-accounts GetUserBankAccounts
 * @apiDescription     Get a User BankAccounts
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

/** @var Route $router */
$router->get('users/{user_id}/bank-accounts', [
    'as' => 'api_bank_get_user_bank_accounts',
    'uses'  => 'Controller@getUserBankAccounts',
    'middleware' => [
      'auth:api',
    ],
]);
