<?php

/**
 * @apiGroup           IPG
 * @apiName            verifyTransaction
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
$router->post('ipg/verify', [
    'as' => 'api_ipg_verify_transaction',
    'uses'  => 'Controller@verifyTransaction',
    'domain' => 'ipg.'. parse_url(\Config::get('app.url'))['host'],
]);
