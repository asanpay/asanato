<?php

namespace App\Containers\IdentityProof\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserNotAdminException.
 */
class UserMobileNotProvedException extends Exception
{
    public $httpStatusCode = Response::HTTP_FORBIDDEN;

    public $message = 'User mobile is not proved!';
}
