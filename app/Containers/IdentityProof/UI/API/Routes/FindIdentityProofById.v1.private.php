<?php

/**
 * @apiGroup           IdentityProof
 * @apiName            findIdentityProofById
 *
 * @api                {GET} /v1/identity-proofs/:id Endpoint title here..
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
$router->get('identity-proofs/{id}', [
    'as' => 'api_identityproof_find_identity_proof_by_id',
    'uses'  => 'Controller@findIdentityProofById',
    'middleware' => [
      'auth:api',
    ],
]);
