<?php

namespace App\Containers\Wallet\Tasks;

use App\Containers\Wallet\Data\Repositories\TxRepository;
use App\Containers\Wallet\Models\Tx;
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

    public function run(array $data): Tx
    {
        try {
            $tx = $this->repository->create($data);

            return $tx;
        }
        catch (Exception $e) {
            XLog::exception($e);
            throw new CreateResourceFailedException();
        }
    }
}
