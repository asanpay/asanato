<?php

namespace App\Containers\Withdrawal\Tasks;

use App\Containers\Withdrawal\Data\Repositories\WithdrawalRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindWithdrawalByIdTask extends Task
{

    protected $repository;

    public function __construct(WithdrawalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->find($id);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
