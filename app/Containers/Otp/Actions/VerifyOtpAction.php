<?php


namespace App\Containers\Otp\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Otp\Enum\OtpReason;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class VerifyOtpAction extends Action
{
    /**
     * @param DataTransporter $data
     *
     * @param bool $markTokenAsUsed
     * @return array
     */
    public function run(DataTransporter $data, $markTokenAsUsed = true): array
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
                return [false, "could not detect OTP reason: {$data->reason}"];
            }
        }

        $broker = Apiato::call('Otp@GetOtpBrokerByReasonTask', [$data->reason]);

        // find used latest OTP
        $otpTokenRow = Apiato::call('Authorization@GetLatestUnusedOtpTask', [
            $data->to,
            OtpReason::SIGN_UP,
            $broker,
        ]);

        if (is_null($otpTokenRow) || $otpTokenRow->verify($data->token) !== true) {
            // invalid OTP token notifications
            return [false, __('auth.invalid_otp')];
        } else {
            // flag OTP token as used
            if ($markTokenAsUsed) {
                $otpTokenRow->markAsUsed();
            }

            return [true, null];
        }
    }
}
