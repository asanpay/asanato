<?php
/**
 * @var Route $router
 */
$router->any(
    'callback/{token}',
    [
        'as' => 'web_ipg_transaction_callback',
        'uses'  => 'Controller@transactionCallback',
        'domain' => 'ipg.'. parse_url(\Config::get('app.url'))['host'],
    ]
);
