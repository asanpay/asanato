<?php

namespace App\Containers\Tx\Tasks;

use App\Containers\Tx\Data\Repositories\TxRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteTxTask extends Task
{

    protected $repository;

    public function __construct(TxRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->delete($id);
        }
        catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
