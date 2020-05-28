<?php

namespace App\Containers\Otp\Tasks;

use App\Containers\Otp\Data\Repositories\OtpTokenRepository;
use App\Containers\Otp\Models\OtpToken;
use App\Ship\Parents\Tasks\Task;

/**
 * Class GetLatestUnusedOtpTask
 * @package App\Containers\Authorization\Tasks
 */
class GetLatestUnusedOtpTask extends Task
{

    protected $repository;

    public function __construct(OtpTokenRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(string $to, string $reason, string $broker): ?OtpToken
    {
        // same code if previous is unused (in case of SMS delays send same code)
        return $this->repository->makeModel()->getLatestUnusedOtp(
            $to,
            $reason,
            $broker
        );
    }
}
