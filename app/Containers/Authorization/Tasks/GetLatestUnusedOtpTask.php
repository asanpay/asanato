<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\OtpTokenRepository;
use App\Containers\Authorization\Data\Transporters\CreateOtpTokenTransporter;
use App\Containers\Authorization\Models\OtpToken;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

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

    public function run(string $mobile, string $reason, string $driver): ?OtpToken
    {
        // same code if previous is unused (in case of SMS delays send same code)
        return $this->repository->makeModel()->getLatestUnusedOtp(
            mobilify($mobile),
            $reason,
            $driver
        );
    }
}
