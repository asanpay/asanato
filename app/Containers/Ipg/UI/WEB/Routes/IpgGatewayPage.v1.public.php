<?php
/**
 * @var Route $router
 */
$router->any(
    'gate/{token}',
    [
        'as' => 'web_ipg_gateway',
        'uses'  => 'Controller@gatewayPage',
        'domain' => 'ipg.'. parse_url(\Config::get('app.url'))['host'],
    ]
);
