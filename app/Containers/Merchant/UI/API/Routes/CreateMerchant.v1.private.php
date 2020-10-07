<?php

/**
 * @apiGroup           Merchant
 * @apiName            createMerchant
 *
 * @api                {POST} /v1/merchants Create Merchant
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  name
 * @apiParam           {String}  domain
 * @apiParam           {Array}  ip_addresses
 * @apiParam           {Boolean}  multiplex_support
 * @apiParam           {Array}  sharing
 *
 * @apiParamExample {json} Request-Example:
{
    "name":"test merchant",
    "domain":"test.com",
    "ip_access": [
        "127.0.0.1",
        "192.168.1.5"
    ],
    "multiplex_support": false,
    "sharing":[
        {
            "wallet": "dzq4k997eww85nea",
            "share": 100
        }
    ]
}
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

/** @var Route $router */
$router->post('merchants', [
    'as' => 'api_merchant_create_merchant',
    'uses'  => 'Controller@createMerchant',
    'middleware' => [
      'auth:api',
    ],
]);
