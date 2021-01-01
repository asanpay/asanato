<?php

/**
 * @apiGroup Bank
 * @apiName  findBankById
 *
 * @api            {GET} /v0/banks/:id findBankById
 * @apiDescription FindBankById
 *
 * @apiVersion    1.0.0
 * @apiPermission none
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
    'banks/{id}',
    [
        'as' => 'api_bank_find_bank_by_id',
        'uses'  => 'Controller@findBankById',
        'middleware' => [
            'auth:api',
        ],
    ]
);
