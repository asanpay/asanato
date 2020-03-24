<?php

namespace App\Containers\Authorization\Providers;

use App\Containers\Authorization\Models\OtpToken;
use App\Containers\Authorization\Services\OtpBrokerManager;
use App\Ship\Parents\Providers\MainProvider;
use Spatie\Permission\PermissionServiceProvider;

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
        PermissionServiceProvider::class,
        MiddlewareServiceProvider::class
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    public $aliases = [

    ];

    public function register()
    {
       $this->registerOtpBroker();
    }

    protected function registerOtpBroker()
    {
        $this->app->singleton('otp.manager', function ($app) {
            return new OtpBrokerManager($app);
        });

        $this->app->bind('otp.model', function ($app) {
            return new OtpToken();
        });
    }

    public function provides()
    {
        return ['otp.manager', 'otp.model'];
    }
}
