<?php
/** @var Route $router */
$router->any('ipg/callback/{psp}/{gateway}/{token}', [
    'as' => 'web_ipg_transaction_callback',
    'uses'  => 'Controller@transactionCallback',
    'domain' => 'ipg.'. parse_url(\Config::get('app.url'))['host'],
]);
