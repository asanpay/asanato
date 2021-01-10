<?php

namespace App\Containers\Documentation\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class WrongDocTypeException
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class WrongDocTypeException extends Exception
{
    public $httpStatusCode = Response::HTTP_MISDIRECTED_REQUEST;

    public $message = 'Unsupported Documentation Type.';
}
