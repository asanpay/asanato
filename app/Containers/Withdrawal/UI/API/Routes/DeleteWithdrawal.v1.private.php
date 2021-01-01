<?php

/**
 * @apiGroup Withdrawal
 * @apiName  deleteWithdrawal
 *
 * @api            {DELETE} /v1/withdrawals/:id Cancel Withdrawal
 * @apiDescription Cancel a withdrawal request
 *
 * @apiVersion    1.0.0
 * @apiPermission delete-withdrawals
 *
 * @apiSuccessExample {json}  Success-Response:
 * HTTP/1.1 204 No Content
 */

/**
 * @var Route $router
 */
$router->delete(
    'withdrawals/{id}',
    [
        'as' => 'api_withdrawal_delete_withdrawal',
        'uses'  => 'Controller@deleteWithdrawal',
        'middleware' => [
            'auth:api',
        ],
    ]
);
