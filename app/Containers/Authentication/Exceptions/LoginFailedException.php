<?php

namespace App\Containers\Authentication\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginFailedException
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class LoginFailedException extends Exception
{
    public $httpStatusCode = Response::HTTP_BAD_REQUEST;

    public $message = 'An Exception happened during the Login Process.';
}
