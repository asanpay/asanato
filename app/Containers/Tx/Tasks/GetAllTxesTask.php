<?php

namespace App\Containers\Tx\Tasks;

use App\Containers\Tx\Data\Repositories\TxRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllTxesTask extends Task
{

    protected $repository;

    public function __construct(TxRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }
}
