<?php

namespace App\Containers\Otp\Providers;

use App\Containers\Otp\Models\OtpToken;
use App\Containers\Otp\Services\OtpBrokerManager;
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
     * @var array
     */
    public $aliases = [
        // 'Foo' => Bar::class,
    ];

    /**
     * Register anything in the container.
     */
    public function register()
    {
        $this->registerOtpBroker();
    }

    protected function registerOtpBroker()
    {
        $this->app->singleton(
            'otp.manager',
            function ($app) {
                return new OtpBrokerManager($app);
            }
        );

        $this->app->bind(
            'otp.model',
            function ($app) {
                return new OtpToken();
            }
        );
    }

    public function provides()
    {
        return ['otp.manager', 'otp.model'];
    }
}
