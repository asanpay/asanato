<?php


namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Enum\OtpBroker;
use App\Containers\Authorization\Enum\OtpReason;
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
        try {
            switch ($data->reason) {
                case OtpReason::REST_PASS: {
                    $data->to = mobilify($data->mobile);
                    break;
                }
                case OtpReason::EMAIL_VERIFY: {
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
                OtpBroker::EMAIL
            ]);

            if ($existToken && $existToken->token == $data->token) {
                $existToken->markAsUsed();
                return [true, null];
            } else {
                return [null, __('auth.otp_not_found')];
            }

        } catch (\Exception $e) {
            if ($this->weAreOnApiDebug()) {
                throw $e;
            }
            return [null, __('app.failed_request')];
        }
    }
}
