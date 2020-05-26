<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Exceptions\GoogleAuthSetBeforeException;
use App\Containers\IdentityProof\Exceptions\UserMobileNotProvedException;
use App\Containers\Otp\Exceptions\InvalidOtpException;
use App\Containers\User\Models\User;
use App\Exception;
use App\Ship\Exceptions\InternalErrorException;
use App\Ship\Parents\Actions\Action;
use Google2FA;
use Illuminate\Support\Facades\Cache;

/**
 * Class SetUserGoogleAuthAction
 */
class SetUserGoogleAuthAction extends Action
{

    /**
     * @return bool
     */
    public function run(User $user, string $token): bool
    {
        if ($user->isProvedMobile() !== true) {
            // just users with proved mobile could get QrCode
            throw new UserMobileNotProvedException();
        }

        if (!empty($user->getGoogleAuthSecret())) {
            throw new GoogleAuthSetBeforeException();
        }

        $tempGoogleAuthCacheKey = "user_google_{$user->id}";

        if (Cache::has($tempGoogleAuthCacheKey)) {
            $secret = Cache::get($tempGoogleAuthCacheKey);
            if (Google2FA::verifyKey($secret, $token)) {
                if ($user->setGoogleAuthSecret($secret)) {
                    Cache::forget($tempGoogleAuthCacheKey);
                    return true;
                } else {
                    throw new InternalErrorException('could not save user google auth secret');
                }
            } else  {
                throw new InvalidOtpException();
            }
        } else {
            throw new Exception('temp google auth secret not found!');
        }
    }
}
