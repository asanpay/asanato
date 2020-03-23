<?php

/**
 * @apiGroup           Authentication
 * @apiName            UserSignUp
 * @api                {post} /v1/signup SignUp
 * @apiDescription     Create client users.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {Int}  code OTP code that user received by his mobile
 * @apiParam           {String}  mobile
 * @apiParam           {String}  password
 * @apiParam           {String}  first_name
 * @apiParam           {String}  last_name
 * @apiParam           {String}  client_ip (optional)
 * @apiParam           {String}  device (WEB,ANDROID,IPHONE)
 *
 */

$router->post('signup', [
    'as' => 'api_user_signup',
    'uses'  => 'Controller@signup',
]);
