<?php

namespace App\Containers\User\Providers;

use App\Containers\User\Models\Observers\UserObserver;
use App\Containers\User\Models\User;
use App\Ship\Parents\Providers\MainProvider;

/**
 * Class MainServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 *
 */
class MainServiceProvider extends MainProvider
{

    /**
     * Container Service Providers.
     *
     * @var array
     */
    public $serviceProviders = [
        // InternalServiceProviderExample::class,
        // ...
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    public $aliases = [

    ];

    /**
     * Register anything in the container.
     */
    public function register()
    {
        parent::register();

        // do your binding here..
        // $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }


    public function boot()
    {
        // observers
        User::observe(UserObserver::class);
        parent::boot();
    }
}
