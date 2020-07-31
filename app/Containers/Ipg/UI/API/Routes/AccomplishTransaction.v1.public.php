<?php

/**
 * @apiGroup           IPG
 * @apiName            accomplishTransaction
 *
 * @api                {POST} /v1/ipg/verify verify a transaction
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  token
 * @apiParam           {String}  merchant
 * @apiParam           {int}     amount (optional) just for comparing by the transaction amount
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

/** @var Route $router */
$router->post('verify', [
    'as' => 'api_ipg_accomplish_transaction',
    'uses'  => 'Controller@accomplishTransaction',
    'domain' => 'ipg.'. parse_url(\Config::get('app.url'))['host'],
]);
