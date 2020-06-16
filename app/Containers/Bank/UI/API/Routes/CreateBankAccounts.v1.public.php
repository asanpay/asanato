<?php

/**
 * @apiGroup           Bank
 * @apiName            createBank
 *
 * @api                {POST} /v1/bank-accounts Create Bank
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
