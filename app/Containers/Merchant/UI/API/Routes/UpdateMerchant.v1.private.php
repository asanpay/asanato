<?php

/**
 * @apiGroup           Merchant
 * @apiName            updateMerchant
 *
 * @api                {PATCH} /v1/merchants/:id Endpoint title here..
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
$router->patch('merchants/{id}', [
    'as' => 'api_merchant_update_merchant',
    'uses'  => 'Controller@updateMerchant',
    'middleware' => [
      'auth:api',
    ],
]);
