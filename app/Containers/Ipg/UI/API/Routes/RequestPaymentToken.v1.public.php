<?php

/**
 * @apiGroup           IPG
 * @apiName            requestPaymentToken
 *
 * @api                {POST} /v1/request-token request a payment request token
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
    "code": 0,
    "token": "APMR-1000011",
    "date": "2020-07-01 16:13:00",
    "jalali_date": "1399/04/11 16:13:00",
    "x_track_id": "504837936b",
    "gate_url": "http://ipg.asanpay.yhn/gate/APMR-1000011"
}
 */

/** @var Route $router */
$router->post('request-token', [
    'as' => 'api_ipg_request_pay_token',
    'uses'  => 'Controller@requestPaymentToken',
    'domain' => 'ipg.'. parse_url(\Config::get('app.url'))['host'],
]);
