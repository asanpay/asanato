<?php

namespace App\Containers\Authorization\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RoleNotFoundException
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class PermissionNotFoundException extends Exception
{
    public $httpStatusCode = Response::HTTP_NOT_FOUND;

    public $message = 'The requested Permission was not found.';
}
