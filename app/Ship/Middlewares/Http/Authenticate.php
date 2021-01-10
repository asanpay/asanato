<?php

namespace App\Ship\Middlewares\Http;

use App\Containers\Authentication\Exceptions\AuthenticationException;
use Exception;
use Illuminate\Auth\Middleware\Authenticate as LaravelAuthenticate;

/**
 * Class Authenticate
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class Authenticate extends LaravelAuthenticate
{
    public function authenticate($request, array $guards)
    {
        try {
            return parent::authenticate($request, $guards);
        } catch (Exception $exception) {
            throw new AuthenticationException();
        }
    }
}
