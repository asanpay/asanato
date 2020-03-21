<?php

namespace App\Containers\Bank\Tasks;

use App\Containers\Bank\Data\Repositories\BankRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllBanksTask extends Task
{

    protected $repository;

    public function __construct(BankRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }
}
