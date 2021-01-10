<?php

namespace Apiato\Core\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class ClassDoesNotExistException
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class ClassDoesNotExistException extends Exception
{
    public $httpStatusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'Class does not exist.';
}
