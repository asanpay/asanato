<?php

namespace App\Containers\Tx\Tasks;

use App\Containers\Tx\Data\Repositories\TxRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindTxByIdTask extends Task
{

    protected $repository;

    public function __construct(TxRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->find($id);
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
