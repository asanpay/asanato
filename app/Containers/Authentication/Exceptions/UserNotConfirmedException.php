<?php

namespace App\Containers\Authentication\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserNotConfirmedException
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class UserNotConfirmedException extends Exception
{
    public $httpStatusCode = Response::HTTP_CONFLICT;

    public $message = 'The user is not confirmed yet. Please verify your user before trying to login.';
}
