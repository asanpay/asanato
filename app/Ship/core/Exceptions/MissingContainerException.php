<?php

namespace Apiato\Core\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class MissingContainerException
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class MissingContainerException extends Exception
{

    public $httpStatusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'Container not installed.';
}
