<?php

namespace App\Containers\Otp\Tasks;

use App\Containers\Otp\Data\Repositories\OtpTokenRepository;
use App\Ship\Parents\Tasks\Task;

class IsIpEligibleToRequestOtpTask extends Task
{
    protected $repository;

    public function __construct(OtpTokenRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($clientIp):array
    {
        // bypass ip check on non-production env
        if ($this->weAreOnProduction() != true) {
            return [true, null];
        }

        $clientIp = ip2long($clientIp);

        $totalUnusedCount = $this->optTokenModel
            ->where('ip', $clientIp)
            ->where('used', false)
            ->whereRaw("created_at >= NOW() - INTERVAL '48 HOURS'")
            ->count();
        if ($totalUnusedCount > config('otp-container.otp.ip_limit', 10)) {
            return [null, __('auth.otp.ip_limit_exceeded')];
        } else {
            return [true, null];
        }
    }
}
