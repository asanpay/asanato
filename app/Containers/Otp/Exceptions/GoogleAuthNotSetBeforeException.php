<?php

namespace App\Containers\Otp\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GoogleAuthNotSetBeforeException
 */
class GoogleAuthNotSetBeforeException extends Exception
{
    public $httpStatusCode = Response::HTTP_UNPROCESSABLE_ENTITY;

    public $message = "User's Google auth has not been set before";
}
