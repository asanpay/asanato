<?php

namespace App\Containers\Withdrawal\Providers;

use App\Containers\Withdrawal\Models\Withdrawal;
use App\Containers\Withdrawal\Observers\WithdrawalObserver;
use App\Ship\Parents\Providers\MainProvider;

/**
 * Class MainServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
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
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    public $aliases = [
        // 'Foo' => Bar::class,
    ];

    /**
     * Register anything in the container.
     */
    public function register()
    {
        parent::register();

        // $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        // ...
    }

    public function boot()
    {
        // observers
        Withdrawal::observe(WithdrawalObserver::class);
        parent::boot();
    }
}
