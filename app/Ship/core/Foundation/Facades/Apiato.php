<?php

namespace Apiato\Core\Foundation\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Apiato
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class Apiato extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Apiato';
    }
}
