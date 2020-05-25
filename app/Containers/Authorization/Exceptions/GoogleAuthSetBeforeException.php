<?php

namespace App\Containers\Authorization\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GoogleAuthSetBeforeException
 */
class GoogleAuthSetBeforeException extends Exception
{
    public $httpStatusCode = Response::HTTP_CONFLICT;

    public $message = "User's Google auth has been set before";
}
