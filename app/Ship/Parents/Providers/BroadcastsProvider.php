<?php

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\BroadcastsProvider as AbstractBroadcastsProvider;
use Illuminate\Support\Facades\Broadcast;
use function app_path;

/**
 * Class BroadcastsProvider
 *
 * A.K.A app/Providers/BroadcastServiceProvider.php
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class BroadcastsProvider extends AbstractBroadcastsProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        include app_path('Ship/Broadcasts/Routes.php');
    }
}
