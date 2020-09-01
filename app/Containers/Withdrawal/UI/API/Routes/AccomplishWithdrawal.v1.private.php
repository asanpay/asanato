<?php

/**
 * @apiGroup           Withdrawal
 * @apiName            accomplishWithdrawal
 *
 * @api                {PATCH} /v1/withdrawals-accomplish/:id Accomplish a withdrawal request
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  tracking_id
 * @apiParam           {String}  processed_at
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
    "data": {
        "object": "Withdrawal",
        "id": "oj65pmmbkyy65v8n",
        "wallet_id": "8rx3l008zoop3wam",
        "bank_account_id": "qnwmkv5704blag6r",
        "sheba": "IR650560088480002835963001",
        "status": 3,
        "created_at": "2020-08-30 01:09:43",
        "processed_at": "2020-08-30 01:09:43",
        "updated_at": "2020-08-30 01:09:43",
        "deleted_at": "2020-08-30 01:09:43"
    },
    "meta": {
        "include": [],
        "custom": []
    },
    "message": "everything's ok",
    "code": 0,
    "xTrackId": "30430a3552"
}
 */

/** @var Route $router */
$router->patch('withdrawals-accomplish/{id}', [
    'as' => 'api_withdrawal_accomplish_withdrawal',
    'uses'  => 'Controller@accomplishWithdrawal',
    'middleware' => [
      'auth:api',
    ],
]);
