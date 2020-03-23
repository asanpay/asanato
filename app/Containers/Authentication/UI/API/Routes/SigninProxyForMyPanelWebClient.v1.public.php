<?php

/**
 * @apiGroup           Authentication
 * @apiName            Controller
 *
 * @api                {POST} /v1/clients/web/my/signin SignIn (My Proxy)
 * @apiDescription     Endpoint login proxy for my panel
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  mobile user mobile
 * @apiParam           {String}  password user password
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
    "token_type": "Bearer",
    "expires_in": 86400,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1Ni...",
    "refresh_token": "def502006983de32fd97f720430dc092..."
}
 */

/** @var Route $router */
$router->post('clients/web/my/signin', [
    'as' => 'api_auth_client_my_web_app_login_proxy',
    'uses'  => 'Controller@proxySigninForMyWebClient',
]);
