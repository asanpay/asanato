<?php

/**
 * @apiGroup Helpdesk
 * @apiName  createHelpdesk
 *
 * @api            {POST} /v1/helpdesks Create Helpdesk
 * @apiDescription Endpoint description here..
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
    'helpdesks',
    [
        'as' => 'api_helpdesk_create_helpdesk',
        'uses'  => 'Controller@createHelpdesk',
        'middleware' => [
            'auth:api',
        ],
    ]
);
