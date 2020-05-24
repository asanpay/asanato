<?php


namespace App\Containers\Otp\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Otp\Enum\OtpBroker;
use App\Containers\Otp\Enum\OtpReason;
use App\Containers\Otp\Exceptions\OtpTokenNotFoundException;
use App\Containers\IdentityProof\Enum\IdPoofType;
use App\Containers\User\Exceptions\UserNotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

class VerifyOtpAction extends Action
{
    /**
     * @param DataTransporter $data
     *
     * @return array
     * @throws \Exception
     */
    public function run(DataTransporter $data): array
    {
        switch ($data->reason) {
            case OtpReason::RESET_PASS:
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
                return [null, "could not detect OTP reason: {$data->reason}"];
            }
        }

        $existToken = Apiato::call('Otp@GetLatestUnusedOtpTask', [
            $data->to,
            $data->reason,
            OtpBroker::EMAIL,
        ]);

        if ($existToken && $existToken->token == $data->token) {
            $user = Apiato::call('User@FindUserByEmailTask', [$data->to]);

            if (!$user) {
                throw new UserNotFoundException();
            }

            $user->verify(IdPoofType::EMAIL);
            $existToken->markAsUsed();

            return [true, null];
        } else {
            throw new OtpTokenNotFoundException();
        }
    }
}
