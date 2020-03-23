<?php

/**
 * @apiGroup           Merchant
 * @apiName            getAllMerchants
 *
 * @api                {GET} /v1/merchants getAllMerchants
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
$router->get('merchants', [
    'as' => 'api_merchant_get_all_merchants',
    'uses'  => 'Controller@getAllMerchants',
    'middleware' => [
      'auth:api',
    ],
]);
