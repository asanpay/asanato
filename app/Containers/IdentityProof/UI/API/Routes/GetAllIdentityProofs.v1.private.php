<?php

/**
 * @apiGroup IdentityProof
 * @apiName  getAllIdentityProofs
 *
 * @api            {GET} /v1/identity-proofs Get all users ID proofs
 * @apiDescription Endpoint description here..
 *
 * @apiVersion    1.0.0
 * @apiPermission none
 *
 * @apiParam {int} user_id
 * @apiParam {String}  type
 * @apiParam {String}  status
 * @apiParam {String}  sort_by default: id
 * @apiParam {String}  sort_dir default: DESC
 * @apiParam {int}  page
 * @apiParam {int}  count
 *
 * @apiSuccessExample {json}  Success-Response:
 * HTTP/1.1 200 OK
 {
     // Insert the response of the request here...
}
 */

/**
 * @var Route $router
 */
$router->get(
    'identity-proofs',
    [
        'as' => 'api_id_proof_get_all_identity_proofs',
        'uses'  => 'Controller@getAllIdentityProofs',
        'middleware' => [
            'auth:api',
        ],
    ]
);
