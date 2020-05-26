<?php

namespace App\Containers\Otp\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;
use Google2FA;

class VerifyGoogleAuthCodeTask extends Task
{
    public function run(User $user, int $code): bool
    {
        $secret = $user->getGoogleAuthSecret();
        return Google2FA::verifyKey($secret, $code);
    }
}
