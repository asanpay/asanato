<?php

namespace Apiato\Core\Traits\TestsTraits\PhpUnit;

use App;
use Mockery;

/**
 * Class TestsMockHelperTrait
 *
 * Tests helper for mocking objects and services.
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
trait TestsMockHelperTrait
{

    /**
     * Mocking helper
     *
     * @param $class
     *
     * @return \Mockery\MockInterface
     */
    public function mockIt($class)
    {
        $mock = Mockery::mock($class);
        App::instance($class, $mock);

        return $mock;
    }
}
