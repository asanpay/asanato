<?php

/**
 * @apiGroup           IdentityProof
 * @apiName            deleteIdentityProof
 *
 * @api                {DELETE} /v1/identity-proofs/:id Endpoint title here..
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
$router->delete('identity-proofs/{id}', [
    'as' => 'api_identityproof_delete_identity_proof',
    'uses'  => 'Controller@deleteIdentityProof',
    'middleware' => [
      'auth:api',
    ],
]);
