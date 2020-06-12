<?php


namespace App\Containers\Otp\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\IdentityProof\Enum\IdPoofType;
use App\Containers\Otp\Enum\OtpReason;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;

class VerifyOtpAction extends Action
{
    /**
     * @param User $user
     * @param int $token
     * @param string $reason
     * @return bool
     */
    public function run(User $user, int $token, string $reason): bool
    {
        // verify token
        if (strlen($token) == 6) {
            // code is in Google Auth token format -- No reason required
            $status = Apiato::call('Otp@VerifyGoogleAuthCodeTask', [$user, $token]);
        } else {
            if (strlen($token) == 4) {
                // SMS/Email token format
                $status = Apiato::call('Otp@VerifyOtpCodeTask', [$user, $token, $reason]);
            } else {
                // unknown otp format
                $status = false;
            }
        }

        //@todo move following part to a TASK
        if ($status === true) {
            switch ($reason) {
                case OtpReason::EMAIL_VERIFY:
                {
                    $user->verify(IdPoofType::EMAIL);
                    break;
                }
            }
        }

        return $status;
    }
}
