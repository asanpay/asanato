<?php

namespace App\Containers\Authorization\Providers;

use App\Ship\Parents\Providers\MiddlewareProvider;

/**
 * Class MiddlewareServiceProvider
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class MiddlewareServiceProvider extends MiddlewareProvider
{
    /**
     * Register Middleware's
     *
     * @var array
     */
    protected $middlewares = [
        // ..
    ];

    /**
     * Register Container Middleware Groups
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [

        ],
        'api' => [

        ],
    ];

    protected $routeMiddleware = [
        // Laravel default route middleware's:
        'can'      => \Illuminate\Auth\Middleware\Authorize::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ];
}
