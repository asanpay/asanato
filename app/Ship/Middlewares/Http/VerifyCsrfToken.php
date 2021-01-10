<?php

namespace App\Ship\Middlewares\Http;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

/**
 * Class VerifyCsrfToken
 *
 * A.K.A app/Http/Middleware/VerifyCsrfToken.php
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class VerifyCsrfToken extends Middleware
{

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/callback/*'
    ];
}
