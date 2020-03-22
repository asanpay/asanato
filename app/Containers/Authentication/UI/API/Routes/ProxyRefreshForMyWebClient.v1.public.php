<?php

/**
 * @apiGroup           OAuth2
 * @apiName            ClientMyWebAppRefreshProxy
 * @api                {post} /v1/clients/web/my/refresh Refresh
 * @apiDescription     If `refresh_token` is not provided the w'll try to get it from the http cookie.
 *
 * @apiVersion         1.0.0
 *
 * @apiParam           {String}  [refresh_token] The refresh Token
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
{
  "token_type": "Bearer",
  "expires_in": 315360000,
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbG...",
  "refresh_token": "ZFDPA1S7H8Wydjkjl+xt+hPGWTagX..."
}
 */
$router->post('clients/web/my/refresh', [
    'as' => 'api_auth_client_my_web_app_refresh_proxy',
    'uses'  => 'Controller@proxyRefreshForMyWebClient',
]);
