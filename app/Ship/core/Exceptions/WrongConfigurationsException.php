<?php

namespace Apiato\Core\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * Class WrongConfigurationsException
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class WrongConfigurationsException extends Exception
{

    public $httpStatusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'Ops! Some Containers configurations are incorrect!';
}
