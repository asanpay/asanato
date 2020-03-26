<?php

/**
 * @apiGroup           Users
 * @apiName            getAuthenticatedUserIdProofs
 *
 * @api                {GET} /v1/user/profile Get Identity Proofs
 * @apiDescription     Find the user identity proofs information
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *

 */

$router->get('user/id-proofs', [
    'as' => 'api_user_get_auth_user_id_proofs',
    'uses'  => 'Controller@getAuthenticatedUserIdProofs',
    'middleware' => [
      'auth:api',
    ],
]);
