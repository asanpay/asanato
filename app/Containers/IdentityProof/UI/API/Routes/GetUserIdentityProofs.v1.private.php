<?php

/**
 * @apiGroup           IdentityProof
 * @apiName            getUserIdentityProofs
 *
 * @api                {GET} /v1/users/{id}/identity-proofs Get user ID proofs
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  type
 * @apiParam           {String}  status
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

/** @var Route $router */
$router->get('users/{id}/identity-proofs', [
    'as' => 'api_id_proof_get_all_identity_proofs',
    'uses'  => 'Controller@getUserIdentityProofs',
    'middleware' => [
      'auth:api',
    ],
]);
