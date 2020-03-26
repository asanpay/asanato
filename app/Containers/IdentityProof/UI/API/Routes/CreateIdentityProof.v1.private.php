<?php

/**
 * @apiGroup           IdentityProof
 * @apiName            createIdentityProof
 *
 * @api                {POST} /v1/identity-proofs Endpoint title here..
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
$router->post('identity-proofs', [
    'as' => 'api_id_proof_create_identity_proof',
    'uses'  => 'Controller@createIdentityProof',
    'middleware' => [
      'auth:api',
    ],
]);
