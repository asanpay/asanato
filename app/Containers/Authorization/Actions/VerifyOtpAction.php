<?php


namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Enum\OtpBroker;
use App\Containers\Authorization\Enum\OtpReason;
use App\Containers\Authorization\Exceptions\OtpTokenNotFoundException;
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
            case OtpReason::REST_PASS:
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

        $existToken = Apiato::call('Authorization@GetLatestUnusedOtpTask', [
            $data->to,
            $data->reason,
            OtpBroker::EMAIL,
        ]);

        if ($existToken && $existToken->token == $data->token) {
            $user = Apiato::call('User@FindUserByMobileTask', [$data->to]);

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
