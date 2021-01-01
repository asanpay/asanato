<?php

/**
 * @apiGroup IdentityProof
 * @apiName  updateIdentityProof
 *
 * @api            {PATCH} /v1/identity-proofs/:id Endpoint title here..
 * @apiDescription Endpoint description here..
 *
 * @apiVersion    1.0.0
 * @apiPermission none
 *
 * @apiParam {String}  parameters here..
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
$router->patch(
    'identity-proofs/{id}',
    [
        'as' => 'api_identityproof_update_identity_proof',
        'uses'  => 'Controller@updateIdentityProof',
        'middleware' => [
            'auth:api',
        ],
    ]
);
