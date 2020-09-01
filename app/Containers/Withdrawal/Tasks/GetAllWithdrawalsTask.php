<?php

namespace App\Containers\Withdrawal\Tasks;

use App\Containers\Withdrawal\Data\Repositories\WithdrawalRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllWithdrawalsTask extends Task
{

    protected $repository;

    public function __construct(WithdrawalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }
}
