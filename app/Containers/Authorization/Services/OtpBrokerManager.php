<?php

namespace App\Containers\Authorization\Services;

use App\Containers\Authorization\Enum\OtpBroker;
use App\Containers\Authorization\Models\OtpToken;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\InternalErrorException;
use App\Ship\Jobs\SendSms;

class OtpBrokerManager
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;


    protected string $reason;

    /**
     * @var array $config
     */
    protected array $config;

    /**
     * Create a new PasswordBroker manager instance.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->loadConfig();
    }

    public function sendOtp(string $to, string $reason, string $clientIp = null): array
    {
        $brokerName = $this->getBrokerForReason($reason);

        if (isset($this->config['ip_check']) && $this->config['ip_check'] == true) {
            // bypass ip check on non-production env
            if (!app()->runningInConsole() && app()->environment('production')) {
                list($r, $err) = $this->ipCheck($clientIp);
                if (!empty($err)) {
                    return [null, $err];
                }
            }

            // check throttle
            list($_, $err) = $this->throttleCheck($to, $brokerName);
            if (!empty($err)) {
                return [null, $err];
            }

            $otpToken = $this->createNewToken($to, $reason, $brokerName, $clientIp);

            return $this->process($otpToken);

        }
    }

    public function process(OtpToken $otpToken): array
    {
        switch ($otpToken->broker) {
            case OtpBroker::MOBILE:
            {
                return $this->sendBySms($otpToken);
            }
        }
    }

    private function sendBySms(OtpToken $otpToken): array
    {
        $message = __('auth.otp.your_sms_otp', [
                'token'  => $otpToken->token,
                'reason' => $otpToken->reason,
            ]) . PHP_EOL . __('app.name');

        $ttl = $otpToken->expired_at ? strtotime($otpToken->expired_at) : null;

        dispatch((new SendSms($otpToken->to, $message, $ttl))->onQueue('high'));

        return [__('auth.otp.sms_otp_sent', ['mobile' => $otpToken->to]), null];
    }

    /**
     * @param $reason
     *
     * @return int|string
     */
    public function getBrokerForReason($reason)
    {
        foreach ($this->config['brokers'] as $broker => $reasons) {
            if (in_array($reason, explode(',', $reasons))) {
                return $broker;
            }
        }

        throw new InternalErrorException("could not detect OTP broker for reason {$reason}");
    }

    private function loadConfig(): void
    {
        $this->config = $this->app['config']['authorization-container']['otp'];
    }

    private function ipCheck(string $clientIp): array
    {
        $clientIp = ip2long($clientIp);

        $totalUnusedCount = resolve('otp.model')->where('ip', $clientIp)
            ->where('used', false)
            ->whereRaw("created_at >= NOW() - INTERVAL '{$this->config['ip_limit_hours']} HOURS'")
            ->count();

        if ($totalUnusedCount > $this->config['ip_limit_count']) {
            return [null, __('auth.otp.ip_limit_exceeded')];
        } else {
            return [true, null];
        }
    }

    private function throttleCheck(string $to, string $broker): array
    {
        $totalUnusedCount = resolve('otp.model')->select('created_at')
            ->where('to', $to)
            ->where('used', false)
            ->where('broker', $broker)
            ->whereRaw("created_at >= NOW() - INTERVAL '{$this->config['throttle_limit_hours']} HOURS'")
            ->orderBy('id', 'DESC')
            ->get();

        $count       = $totalUnusedCount->count();
        $otpGapLimit = $this->config['throttle_gap_seconds'];

        if ($count >= $this->config['throttle_limit_count']) {
            return [null, __('auth.otp.too_many_otp_try')];
        } elseif ($count > 0 && (time() - strtotime($totalUnusedCount->first()->created_at) <= $otpGapLimit)) {
            return [null, __('auth.otp.otp_gap', ['seconds' => $otpGapLimit])];
        } else {
            return [true, null];
        }
    }

    private function createNewToken(string $to, string $reason, string $broker, string $clientIp = null)
    {
        try {
            // same code if previous is unused (in case of SMS delays send same code)
            $prev = resolve('otp.model')->where('to', $to)
                ->where('broker', $broker)
                ->orderBy('id', 'DESC')
                ->first();

            if ($prev && $prev->expired = false && $prev->used == false) {
                $code = $prev->code;
            } else {
                $code = mt_rand(1000, 9999);
            }

            $token             = resolve('otp.model');
            $token->to         = $to;
            $token->broker     = $broker;
            $token->token      = $code;
            $token->expired_at = strtotime($this->config['ttl']);
            $token->reason     = $reason;
            $token->ip         = $clientIp ? ip2long($clientIp) : 0;
            $token->save();

            return $token;
        } catch (\Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
