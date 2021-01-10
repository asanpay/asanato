<?php

namespace App\Ship\Parents\Providers;

use Apiato\Core\Abstracts\Providers\EventsProvider as AbstractEventsProvider;

/**
 * Class EventsProvider
 *
 * A.K.A app/Providers/EventsServiceProvider.php
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class EventsProvider extends AbstractEventsProvider
{

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

    ];


    /**
     * Register any other events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
