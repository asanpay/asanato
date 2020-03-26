<?php


namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Data\Transporters\CreateOtpTokenTransporter;
use App\Containers\Authorization\Enum\OtpReason;
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
                    $data->to = mobilify($data->mobile);

                    // check for existing mobile
                    $existUser = Apiato::call('User@FindUserByMobileTask', [$data->to]);
                    if ($existUser) {
                        return ['null', __('auth.signup.dup_conf_mobile')];
                    }
                    break;
                }
                case OtpReason::REST_PASS: {
                    $data->to = mobilify($data->mobile);

                    $existUser = Apiato::call('User@FindUserByMobileTask', [$data->to]);
                    if (!$existUser) {
                        return ['null', __('auth.user_not_found')];
                    }
                    break;
                }
                case OtpReason::EMAIL_VERIFY: {
                    $data->to = strtolower($data->email);

                    $existUser = Apiato::call('User@FindUserByEmailTask', [$data->to]);
                    if (!$existUser) {
                        return ['null', __('auth.user_not_found')];
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
