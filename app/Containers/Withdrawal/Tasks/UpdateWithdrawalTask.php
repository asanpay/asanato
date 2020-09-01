<?php

namespace App\Containers\Withdrawal\Tasks;

use App\Containers\Withdrawal\Data\Repositories\WithdrawalRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Tartan\Log\Facades\XLog;

class UpdateWithdrawalTask extends Task
{

    protected $repository;

    public function __construct(WithdrawalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            return $this->repository->update($data, $id);
        }
        catch (Exception $exception) {
            XLog::exception($exception);
            throw new UpdateResourceFailedException();
        }
    }
}
