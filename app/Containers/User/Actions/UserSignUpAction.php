<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Data\Transporters\ProxyApiLoginTransporter;
use App\Containers\Authorization\Enum\OtpBroker;
use App\Containers\Authorization\Enum\OtpReason;
use App\Containers\User\Data\Transporters\UserSignUpTransporter;
use App\Ship\Enum\ApiCodes;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Support\Facades\DB;

class UserSignUpAction extends Action
{
    public function run(UserSignUpTransporter $t): array
    {
        $existingUserWithMobileNumber = Apiato::call('User@FindUserByMobileTask', [$t->mobile]);;

        if ($existingUserWithMobileNumber) {
            return [ApiCodes::CODE_DUPLICATE, __('auth.signup.dup_conf_mobile')];
        } else {
           return $this->registerUser($t);
        }
    }

    public function registerUser(UserSignUpTransporter $t): array
    {

        try {
            DB::beginTransaction();

            // find used latest OTP
            $otpToken = Apiato::call('Authorization@GetLatestUnusedOtpTask', [
                $t->mobile,
                OtpReason::SIGN_UP,
                OtpBroker::MOBILE
            ]);


            if (is_null($otpToken) || ($t->token !== intval($otpToken->token))) {
                // invalid OTP token notifications
                return [ApiCodes::CODE_INVALID_OTP, __('auth.invalid_otp')];
            } else {
                // flag OTP token as used
                $otpToken->markAsUsed();
            }

            // mark user mobile as verified because of OTP
            $t->should_verify_mobile = true;

            Apiato::call('User@CreateUserByCredentialsTask', [$t]);

            $oauthClientInfo  = Apiato::call('Authentication@GetOauthClientForDeviceTask', [$t->device]);

            $dataTransporter = new ProxyApiLoginTransporter(
                array_merge($t->toArray(), $oauthClientInfo)
            );

            $result = Apiato::call('Authentication@ProxyApiLoginAction', [$dataTransporter]);

            DB::commit();

            return [$result, null];

        } catch (\Exception $e) {
            DB::rollBack();
            if ($this->weAreOnApiDebug()) {
                throw $e;
            } else {
                $m = __('app.unknown_err');
            }

            return [ApiCodes::CODE_UNKNOWN_ERROR, $m];
        }
    }
}
