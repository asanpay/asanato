<?php

namespace App\Containers\Otp\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Otp\Exceptions\GoogleAuthSetBeforeException;
use App\Containers\IdentityProof\Exceptions\UserMobileNotProvedException;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Cache;

/**
 * Class AssignUserToRoleAction.
 */
class GetTempGoogleAuthDataAction extends Action
{

    /**
     * @return array
     */
    public function run(User $user): array
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
            $newSecret = Cache::get($tempGoogleAuthCacheKey);
        } else {
            $newSecret = Apiato::call('Otp@GenerateNewGoogleAuthSecretTask');
            Cache::put($tempGoogleAuthCacheKey, $newSecret, 2*60*60); // 2 hours
        }

        $qr = Apiato::call('Otp@GenerateGoogleAuthQrCodeTask', [$user->mobile, $newSecret]);

        return [
            'secret'  => $newSecret,
            'qr_code' => $qr
        ];
    }
}
