<?php

namespace App\Containers\Bank\Tasks;

use App\Containers\Bank\Data\Repositories\BankRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Tartan\Log\Facades\XLog;

class CreateBankTask extends Task
{

    protected $repository;

    public function __construct(BankRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
            return $this->repository->create($data);
        } catch (Exception $exception) {
            XLog::exception($exception);
            throw new CreateResourceFailedException();
        }
    }
}
