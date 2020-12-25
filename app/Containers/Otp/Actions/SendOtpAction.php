<?php


namespace App\Containers\Otp\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Otp\Data\Transporters\CreateOtpTokenTransporter;
use App\Containers\Otp\Enum\OtpReason;
use App\Containers\User\Exceptions\UserNotFoundException;
use App\Ship\Parents\Actions\Action;

class SendOtpAction extends Action
{
    /**
     * @param CreateOtpTokenTransporter $data
     *
     * @return array
     * @throws \Exception
     */
    public function run(CreateOtpTokenTransporter $data): array
    {
        try {
            switch ($data->reason) {
                case OtpReason::SIGN_UP:
                {
                    // normalize phone number
                    $data->to = mobilify($data->to);

                    // check for existing mobile
                    $existUser = Apiato::call('User@FindUserByMobileTask', [$data->to]);
                    if ($existUser) {
                        return [null, __('auth.signup.dup_conf_mobile')];
                    }
                    break;
                }
                case OtpReason::RESET_PASS:
                case OtpReason::TRANSFER_MONEY: {
                    $data->to = mobilify($data->mobile);

                    $existUser = Apiato::call('User@FindUserByMobileTask', [$data->to]);
                    if (!$existUser) {
                        throw new UserNotFoundException();
                    }
                    break;
                }
                case OtpReason::EMAIL_VERIFY: {
                    $data->to = strtolower($data->email);

                    $existUser = Apiato::call('User@FindUserByEmailTask', [$data->to]);
                    if (!$existUser) {
                        throw new UserNotFoundException();
                    }

                    if ($existUser->isProvedEmail()) {
                        return [null, __('auth.otp.user_email_already_proofed')];
                    }

                    break;
                }
                default:
                {
                    return [null, "could not detect OTP reason: {$data->reason}"];
                }
            }

            // send otp
            return app('otp.manager')->sendOtp($data->to, $data->reason, $data->ip);
        } catch (\Exception $e) {
            if ($this->weAreOnApiDebug()) {
                throw $e;
            }
            return [null, __('auth.otp.opt_send_err')];
        }
    }
}
