<?php

namespace App\Containers\Otp\Tasks;

use App\Ship\Parents\Tasks\Task;
use Google2FA;

class GenerateNewGoogleAuthSecretTask extends Task
{

    public function run(): string
    {
        return Google2FA::generateSecretKey(
            config('google2fa.key.size', 32),
            config('google2fa.key.prefix', '')
        );
    }
}
