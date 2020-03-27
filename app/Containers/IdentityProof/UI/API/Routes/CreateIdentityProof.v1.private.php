<?php

/**
 * @apiGroup           IdentityProof
 * @apiName            createIdentityProof
 *
 * @api                {POST} /v1/user/{id}/identity-proofs create an IDProof
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {string} id hashed id of the user
 * @apiParam           {int}    type proof type
 * @apiParam           {files}  doc file to upload (only image and pdf accepted)
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

/** @var Route $router */
$router->post('users/{id}/identity-proofs', [
    'as' => 'api_id_proof_create_identity_proof',
    'uses'  => 'Controller@createIdentityProof',
    'middleware' => [
      'auth:api',
    ],
]);
