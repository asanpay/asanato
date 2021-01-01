<?php

/**
 * @apiGroup Bank
 * @apiName  deleteBank
 *
 * @api            {DELETE} /v1/banks/:id Delete Bank
 * @apiDescription Delete Bank
 *
 * @apiVersion    1.0.0
 * @apiPermission none
 *
 * @apiSuccessExample {json}  Success-Response:
 * HTTP/1.1 204 No Content
 */

/**
 * @var Route $router
 */
$router->delete(
    'banks/{id}',
    [
        'as' => 'api_bank_delete_bank',
        'uses'  => 'Controller@deleteBank',
        'middleware' => [
            'auth:api',
        ],
    ]
);
