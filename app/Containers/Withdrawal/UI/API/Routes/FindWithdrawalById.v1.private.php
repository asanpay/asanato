<?php

/**
 * @apiGroup Withdrawal
 * @apiName  findWithdrawalById
 *
 * @api            {GET} /v1/withdrawals/:id Read Withdrawal
 * @apiDescription Read a withdrawal request
 *
 * @apiVersion    1.0.0
 * @apiPermission read-withdrawals
 *
 * @apiParam {String}  parameters here..
 *
 * @apiSuccessExample {json}  Success-Response:
 * HTTP/1.1 200 OK
 {
     "data": {
     "object": "Withdrawal",
         "id": "dzq4k997eww85nea",
         "wallet_id": "8rx3l008zoop3wam",
         "bank_account_id": "qnwmkv5704blag6r",
         "sheba": "IR650560088480002835963001",
         "status": 0,
         "created_at": "2020-08-30 15:09:39",
         "processed_at": null,
         "canceled_at": null,
         "updated_at": "2020-08-30 15:09:39",
         "deleted_at": "2020-08-30 15:09:39"
    },
    "meta": {
    "include": [],
        "custom": []
    },
    "message": "everything's ok",
    "code": 0,
    "xTrackId": "c6bd77c509"
}
 */

/**
 * @var Route $router
 */
$router->get(
    'withdrawals/{id}',
    [
        'as' => 'api_withdrawal_find_withdrawal_by_id',
        'uses'  => 'Controller@findWithdrawalById',
        'middleware' => [
            'auth:api',
        ],
    ]
);
