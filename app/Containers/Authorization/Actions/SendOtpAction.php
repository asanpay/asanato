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
use Tartan\Log\Facades\XLog;

class SendOtpAction extends Action
{
    /**
     * @param CreateOtpTokenTransporter $data
     *
     * @return array
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
                    $mobile = mobilify($data->mobile);

                    list ($eligible, $err) = $this->isEligibleToRequestOtpByMobile($mobile, OtpDriver::SMS);
                    if ($eligible === true) {
                        $data->via = mobilify($data->mobile);

                        $otpToken = Apiato::call('Authorization@CreateOtpTokenTask', [$data]);

                        $this->sendBySms($mobile, $otpToken->code);

                        return [__('auth.otp.sms_otp_sent', ['mobile' => $mobile]), null];
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
            if (config('apiato.api.debug')) {
                return [null, $e->getMessage()];
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
