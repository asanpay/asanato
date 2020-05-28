<?php

namespace App\Containers\Otp\Tasks;

use App\Containers\Authorization\Exceptions\GoogleAuthNotSetBeforeException;
use App\Containers\IdentityProof\Exceptions\UserMobileNotProvedException;
use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;
use Google2FA;

class VerifyGoogleAuthCodeTask extends Task
{
    public function run(User $user, int $code): bool
    {
        if ($user->isProvedMobile() !== true) {
            // just users with proved mobile could get QrCode
            throw new UserMobileNotProvedException();
        }

        if (empty($user->getGoogleAuthSecret())) {
            throw new GoogleAuthNotSetBeforeException();
        }

        $secret = $user->getGoogleAuthSecret();

        return Google2FA::verifyKey($secret, $code);
    }
}
