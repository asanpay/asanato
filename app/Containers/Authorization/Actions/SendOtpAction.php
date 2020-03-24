<?php


namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authorization\Data\Transporters\CreateOtpTokenTransporter;
use App\Containers\Authorization\Enum\OtpDriver;
use App\Containers\Authorization\Enum\OtpReason;
use App\Containers\Authorization\Models\OtpToken;
use App\Ship\Enum\ApiCodes;
use App\Ship\Jobs\SendSms;
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

            list ($_, $err) = $this->isIpEligibleToRequestOtp($data->ip);
            if ($err !== null) {
                return [null, $err];
            }

            switch ($data->reason) {
                case OtpReason::SIGN_UP:
                {
                    // normalize phone number
                    $data->via = mobilify($data->mobile);

                    // check for existing mobile
                    $existUser = Apiato::call('User@FindUserByMobileTask', [$data->via]);
                    if ($existUser) {
                        return ['null', __('auth.signup.dup_conf_mobile')];
                    }

                    list ($eligible, $err) = $this->isEligibleToRequestOtpByMobile($data->via, OtpDriver::SMS);

                    if ($eligible === true) {

                        $otpToken = Apiato::call('Authorization@CreateOtpTokenTask', [$data]);

                        $this->sendBySms($data->via, $otpToken->code);

                        return [__('auth.otp.sms_otp_sent', ['mobile' => $data->via]), null];
                    } else {
                        return [null, $err];
                    }
                }
                case OtpReason::REST_PASS: {
                    $data->via = mobilify($data->mobile);

                    list ($eligible, $err) = $this->isEligibleToRequestOtpByMobile($data->via, OtpDriver::SMS);
                    if ($eligible === true) {

                        $otpToken = Apiato::call('Authorization@CreateOtpTokenTask', [$data]);

                        $this->sendBySms($data->via, $otpToken->code);

                        return [__('auth.otp.sms_otp_sent', ['mobile' => $data->via]), null];
                    } else {
                        return [null, $err];
                    }
                }
                default:
                {
                    return [null, "could not detect OTP driver: {$data->driver}"];
                }
            }
        } catch (\Exception $e) {
            if ($this->weAreOnApiDebug()) {
                throw $e;
            }
            return [null, __('auth.otp.opt_send_err')];
        }
    }

    private function getOtpSmsMessage(int $code)
    {
        return __('auth.otp.your_sms_otp', ['code' => $code]) . PHP_EOL . __('app.name');
    }

    private function sendBySms(string $mobile, string $code): bool
    {
        $message = $this->getOtpSmsMessage($code);

        dispatch((new SendSms($mobile, $message))->onQueue('high'));

        return true;
    }

    private function isEligibleToRequestOtpByMobile(string $mobile, string $driver): array
    {
        $totalUnusedCount = OtpToken::select('created_at')
            ->where('via', $mobile)
            ->where('used', false)
            ->where('driver', $driver)
            ->whereRaw("created_at >= NOW() - INTERVAL '24 HOURS'")
            ->orderBy('id', 'DESC')
            ->get();

        $count         = $totalUnusedCount->count();
        $otpDailyLimit = config('authorization-container.otp.daily_limit', 5);
        $otpGapLimit   = config('authorization-container.otp.gap', 120);

        if ($count >= $otpDailyLimit) {
            return [false, __('auth.otp.too_many_otp_try')];
        } elseif ($count > 0 && (time() - strtotime($totalUnusedCount->first()->created_at) <= $otpGapLimit)) {
            return [false, __('auth.otp.otp_gap', ['seconds' => $otpGapLimit])];
        } else {
            return [true, null];
        }
    }

    private function isIpEligibleToRequestOtp(string $clientIp): array
    {
        // bypass ip check on non-production env
        if ($this->weAreOnProduction()) {
            return [true, null];
        }

        $clientIp = ip2long($clientIp);

        $totalUnusedCount = OtpToken::where('ip', $clientIp)
            ->where('used', false)
            ->whereRaw("created_at >= NOW() - INTERVAL '48 HOURS'")
            ->count();

        if ($totalUnusedCount > config('auth.otp.ip_limit', 10)) {
            return [null, __('auth.otp.ip_limit_exceeded'), ApiCodes::TOO_MANY_REQUESTS];
        } else {
            return [true, null, null];
        }
    }
}
