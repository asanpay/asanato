<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Data\Transporters\ProxyApiLoginTransporter;
use App\Containers\Otp\Enum\OtpBroker;
use App\Containers\Otp\Enum\OtpReason;
use App\Containers\Otp\Exceptions\OtpTokenNotFoundException;
use App\Containers\User\Data\Transporters\UserSignUpTransporter;
use App\Ship\Enum\ApiCodes;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\DB;

class UserSignUpAction extends Action
{
    public function run(UserSignUpTransporter $t): array
    {
        $existingUserWithMobileNumber = Apiato::call('User@FindUserByMobileTask', [$t->mobile]);

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

            $t->reason = OtpReason::SIGN_UP;
            $status = Apiato::call('Otp@VerifyGuestOtpAction', [new DataTransporter($t)]);

            if ($status !== true) {
                throw new OtpTokenNotFoundException();
            }

            // mark user mobile as verified because of OTP
            $t->should_verify_mobile = true;

            $createdUser = Apiato::call('User@CreateUserByCredentialsTask', [$t]);

            // create user's first wallet and make it default
            Apiato::call(
                'Wallet@CreateWalletTask',
                [
                    [
                        'user_id' => $createdUser->id,
                        'name'    => __('wallet::wallet.default'),
                        'default' => true,
                    ],
                ]
            );

            // try to login the new user just after the registration
            $oauthClientInfo = Apiato::call('Authentication@GetOauthClientForDeviceTask', [$t->device]);

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
