<?php

namespace App\Ship\Providers;

use App\Ship\Parents\Providers\MainProvider;
use Creativeorange\Gravatar\GravatarServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaLibraryServiceProvider;
use Tartan\IranianSms\SmsServiceProvider;

/**
 * Class ShipProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ShipProvider extends MainProvider
{

    /**
     * Register any Service Providers on the Ship layer (including third party packages).
     *
     * @var array
     */
    public $serviceProviders = [
        MediaLibraryServiceProvider::class,
        GravatarServiceProvider::class,
        SmsServiceProvider::class,
        \Tartan\Log\XLogServiceProvider::class,
    ];

    /**
     * Register any Alias on the Ship layer (including third party packages).
     *
     * @var  array
     */
    protected $aliases = [
        'Gravatar' => \Creativeorange\Gravatar\Facades\Gravatar::class,
        'XLog' => \Tartan\Log\Facades\XLog::class,
        'IranianSms' => Tartan\IranianSms\Facades\IranianSms::class,
    ];


    public function __construct()
    {
        parent::__construct(app());

        if (class_exists('Barryvdh\Debugbar\ServiceProvider')) {
            $this->serviceProviders[] = \Barryvdh\Debugbar\ServiceProvider::class;
        }

        if (class_exists('Barryvdh\Debugbar\Facade')) {
            $this->aliases[] = \Barryvdh\Debugbar\Facade::class;
        }
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // ...
        parent::boot();

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Validator::extend('integer', function ($attribute, $value, $parameters, $validator) {
            $value = $value + 1 - 1;
            return is_int($value);
        });

        Validator::extend('strength', 'Tartan\Validators\CustomValidator@validateStrength');
        Validator::extend('iran_billing_id', 'Tartan\Validators\CustomValidator@validateIranBillingId');
        Validator::extend('iran_shetab_card', 'Tartan\Validators\CustomValidator@validateShetabCard');
        Validator::extend('iran_national_id', 'Tartan\Validators\CustomValidator@validateNationalId');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Load the ide-helper service provider only in non production environments.
         */
        if ($this->app->environment() !== 'production' && class_exists('Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        parent::register();
    }

}
