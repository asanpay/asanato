<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\OtpTokenRepository;
use App\Ship\Parents\Tasks\Task;


class IsIpEligibleToRequestOtp extends Task
{
    protected $repository;

    public function __construct(OtpTokenRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($clientIp):array
    {
        // bypass ip check on non-production env
        if ($this->weAreOnProduction()) {
            return [true, null];
        }

        $clientIp = ip2long($clientIp);

        $totalUnusedCount = $this->optTokenModel
            ->where('ip', $clientIp)
            ->where('used', false)
            ->whereRaw("created_at >= NOW() - INTERVAL '48 HOURS'")
            ->count();
        if ($totalUnusedCount > config('authorization-container.otp.ip_limit', 10)) {
            return [null, __('auth.otp.ip_limit_exceeded')];
        } else {
            return [true, null];
        }
    }
}
