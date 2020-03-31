<?php

/**
 * @apiGroup           IPG
 * @apiName            requestPaymentToken
 *
 * @api                {POST} /v1/ipg/request-token request a payment request token
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {string}  merchant
 * @apiParam           {int}     amount
 * @apiParam           {int}     invoice_id
 * @apiParam           {String}  callback_url
 * @apiParam           {String}  name payer name (optional)
 * @apiParam           {String}  mobile payer mobile (optional)
 * @apiParam           {String}  email payer email (optional)
 * @apiParam           {String}  description transaction description (optional)
 * @apiParam           {int}     direct use direct payment gateway (bypass asanpay) (optional)
 * @apiParam           {int}     refund not implemented yet (optional)
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

/** @var Route $router */
$router->post('ipg/request-token', [
    'as' => 'api_ipg_request_pay_token',
    'uses'  => 'Controller@requestPaymentToken'
]);
