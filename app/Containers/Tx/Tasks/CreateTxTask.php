<?php

namespace App\Containers\Tx\Tasks;

use App\Containers\Tx\Data\Repositories\TxRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Tartan\Log\Facades\XLog;

class CreateTxTask extends Task
{

    protected $repository;

    public function __construct(TxRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        XLog::debug('creating TX by', $data);

        try {
            return $this->repository->create($data);
        } catch (Exception $exception) {
            XLog::exception($exception);
            throw new CreateResourceFailedException();
        }
    }
}
