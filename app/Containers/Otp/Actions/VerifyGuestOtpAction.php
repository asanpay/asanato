<?php


namespace App\Containers\Otp\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Otp\Enum\OtpReason;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class VerifyGuestOtpAction extends Action
{
    /**
     * @param DataTransporter $data
     *
     * @param bool $markTokenAsUsed
     * @return bool
     */
    public function run(DataTransporter $data): bool
    {
        switch ($data->reason) {
            case OtpReason::RESET_PASS:
            case OtpReason::SIGN_UP:
            case OtpReason::TRANSFER_MONEY:
            {
                $data->to = mobilify($data->mobile);
                break;
            }
            case OtpReason::EMAIL_VERIFY:
            {
                $data->to = strtolower($data->email);
                break;
            }
            default:
            {
                return false;
            }
        }

        $broker = Apiato::call('Otp@GetOtpBrokerByReasonTask', [$data->reason]);

        // find used latest OTP
        $otpTokenRow = Apiato::call('Otp@GetLatestUnusedOtpTask', [
            $data->to,
            $data->reason,
            $broker,
        ]);

        if (is_null($otpTokenRow) || $otpTokenRow->verify($data->token) !== true) {
            // invalid OTP token notifications
            return false;
        } else {
            // flag OTP token as used
            $otpTokenRow->markAsUsed();

            return true;
        }
    }
}
