<?php

/**
 * @apiGroup           Merchant
 * @apiName            deleteMerchant
 *
 * @api                {DELETE} /v1/merchants/:id Endpoint title here..
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
$router->delete('merchants/{id}', [
    'as' => 'api_merchant_delete_merchant',
    'uses'  => 'Controller@deleteMerchant',
    'middleware' => [
      'auth:api',
    ],
]);
