<?php

/**
 * @apiGroup           IdentityProof
 * @apiName            getAllIdentityProofs
 *
 * @api                {GET} /v1/identity-proofs Endpoint title here..
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
$router->get('identity-proofs', [
    'as' => 'api_identityproof_get_all_identity_proofs',
    'uses'  => 'Controller@getAllIdentityProofs',
    'middleware' => [
      'auth:api',
    ],
]);
