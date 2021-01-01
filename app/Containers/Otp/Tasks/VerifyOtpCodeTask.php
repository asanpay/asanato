<?php

namespace App\Containers\Otp\Tasks;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Otp\Enum\OtpBroker;
use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;

class VerifyOtpCodeTask extends Task
{
    /**
     * @param  User   $user
     * @param  int    $code
     * @param  string $reason
     * @return bool
     */
    public function run(User $user, int $code, string $reason): bool
    {
        $otpBroker = Apiato::call('Otp@GetOtpBrokerByReasonTask', [$reason]);

        if ($otpBroker == OtpBroker::EMAIL) {
            $via = emailify($user->email);
        } else {
            $via = mobilify($user->mobile);
        }
        // find used latest OTP
        $otpTokenRow = Apiato::call(
            'Otp@GetLatestUnusedOtpTask',
            [
                $via,
                $reason,
                $otpBroker,
            ]
        );

        if (is_null($otpTokenRow) || $otpTokenRow->verify($code) !== true) {
            // invalid OTP token notifications
            return false;
        } else {
            // mark OTP as used
            $otpTokenRow->markAsUsed();

            return true;
        }
    }
}
