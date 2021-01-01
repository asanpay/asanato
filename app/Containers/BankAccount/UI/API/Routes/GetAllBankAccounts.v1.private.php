<?php

/**
 * @apiGroup BankAccount
 * @apiName  getAllBankAccounts
 *
 * @api            {GET} /v1/bank-accounts GetAllBankAccounts
 * @apiDescription Get All User's BankAccounts
 *
 * @apiVersion    1.0.0
 * @apiPermission read-bank-accounts
 *
 * @apiParam {String}  parameters here..
 *
 * @apiSuccessExample {json}  Success-Response:
 * HTTP/1.1 200 OK
 {
     // Insert the response of the request here...
}
 */

/**
 * @var Route $router
 */
$router->get(
    'bank-accounts',
    [
        'as' => 'api_bank_get_all_bank_accounts',
        'uses'  => 'Controller@getAllBankAccounts',
        'middleware' => [
            'auth:api',
        ],
    ]
);
