<?php

namespace Apiato\Core\Generator;

/**
 * Class GeneratorException
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class GeneratorException extends \Exception
{

    /**
     * The exception description.
     *
     * @var string
     */
    protected $message = 'Could not determine what you are trying to do. Sorry! Check your migration name.';
}
