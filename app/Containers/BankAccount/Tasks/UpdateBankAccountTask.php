<?php

namespace App\Containers\BankAccount\Tasks;

use App\Containers\BankAccount\Data\Repositories\BankAccountRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateBankAccountTask extends Task
{

    protected $repository;

    public function __construct(BankAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            return $this->repository->update($data, $id);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
