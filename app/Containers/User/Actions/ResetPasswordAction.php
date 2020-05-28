<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Otp\Enum\OtpBroker;
use App\Containers\Otp\Enum\OtpReason;
use App\Ship\Exceptions\InternalErrorException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Transporters\DataTransporter;

/**
 * Class ResetPasswordAction
 *
 * * @author  Sebastian Weckend
 */
class ResetPasswordAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return array
     */
    public function run(DataTransporter $data): array
    {
        try {
            $latestToken = Apiato::call('Otp@GetLatestUnusedOtpTask', [
                $data->mobile,
                OtpReason::RESET_PASS,
                OtpBroker::MOBILE
            ]);


            if (!$latestToken) {
                return [null, __('auth.otp_not_found')];
            }

            if ($data->token != $latestToken->token) {
                return [null, __('auth.invalid_otp')];
            }

            $user = Apiato::call('User@FindUserByMobileTask', [$data->mobile]);

            Apiato::call('User@UpdateUserTask', [['password' => bcrypt($data->password)], $user->id]);

            $latestToken->markAsUsed();

            return [__('auth.password_updated'), null];

        } catch (Exception $e) {
            throw new InternalErrorException();
        }
    }
}
