<?php

/**
 * @apiGroup           Merchant
 * @apiName            findMerchantById
 *
 * @api                {GET} /v1/merchants/:id Endpoint title here..
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
$router->get('merchants/{id}', [
    'as' => 'api_merchant_find_merchant_by_id',
    'uses'  => 'Controller@findMerchantById',
    'middleware' => [
      'auth:api',
    ],
]);
