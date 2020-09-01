<?php

namespace App\Containers\Withdrawal\Tasks;

use App\Containers\Withdrawal\Data\Repositories\WithdrawalRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Tartan\Log\Facades\XLog;

class CreateWithdrawalTask extends Task
{

    protected $repository;

    public function __construct(WithdrawalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
            $w = $this->repository->create($data);
            $w->refresh();
            return $w;
        }
        catch (Exception $exception) {
            XLog::exception($exception);
            throw new CreateResourceFailedException();
        }
    }
}
