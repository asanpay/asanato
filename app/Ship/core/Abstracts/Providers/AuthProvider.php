<?php

namespace Apiato\Core\Abstracts\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as LaravelAuthServiceProvider;

/**
 * Class AuthProvider
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class AuthProvider extends LaravelAuthServiceProvider
{

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
