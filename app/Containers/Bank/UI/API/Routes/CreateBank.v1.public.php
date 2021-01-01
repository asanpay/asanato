<?php

/**
 * @apiGroup Bank
 * @apiName  createBank
 *
 * @api            {POST} /v0/banks Create Bank
 * @apiDescription Create Bank
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
$router->post(
    'banks',
    [
        'as' => 'api_bank_create_bank',
        'uses'  => 'Controller@createBank',
        'middleware' => [
            'auth:api',
        ],
    ]
);
