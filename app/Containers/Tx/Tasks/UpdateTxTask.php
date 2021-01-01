<?php

namespace App\Containers\Tx\Tasks;

use App\Containers\Tx\Data\Repositories\TxRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateTxTask extends Task
{

    protected $repository;

    public function __construct(TxRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            return $this->repository->update($data, $id);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
