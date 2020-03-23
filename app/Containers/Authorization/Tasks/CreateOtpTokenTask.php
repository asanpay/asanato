<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Data\Repositories\OtpTokenRepository;
use App\Containers\Authorization\Data\Transporters\CreateOtpTokenTransporter;
use App\Containers\Authorization\Models\OtpToken;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class CreateOtpTokenTask
 * @package App\Containers\Authorization\Tasks
 */
class CreateOtpTokenTask extends Task
{

    protected $repository;

    public function __construct(OtpTokenRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(CreateOtpTokenTransporter $t): OtpToken
    {
        try {
            // same code if previous is unused (in case of SMS delays send same code)
            $prev = $this->repository->makeModel()->where('via', $t->via)
                ->where('driver', $t->driver)
                ->orderBy('id', 'DESC')
                ->first();

            if ($prev && $prev->used == false) {
                $code = $prev->code;
            } else {
                $code = mt_rand(1000, 9999);
            }

            $token         = $this->repository->makeModel();
            $token->via    = $t->via;
            $token->driver = $t->driver;
            $token->code   = $code;
            $token->ttl    = $t->ttl;
            $token->reason = $t->reason;
            $token->ip     = ip2long($t->ip);
            $token->save();

            return $token;
        } catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
