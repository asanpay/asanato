<?php

/**
 * @apiGroup           Merchant
 * @apiName            createMerchant
 *
 * @api                {POST} /v1/merchants Endpoint title here..
 * @apiDescription     Endpoint description here..
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
$router->post('merchants', [
    'as' => 'api_merchant_create_merchant',
    'uses'  => 'Controller@createMerchant',
    'middleware' => [
      'auth:api',
    ],
]);
