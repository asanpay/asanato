<?php

namespace App\Containers\Documentation\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class NoDocTypesFoundException
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class NoDocTypesFoundException extends Exception
{
    public $httpStatusCode = Response::HTTP_MISDIRECTED_REQUEST;

    public $message = 'Please update your config file.';
}
