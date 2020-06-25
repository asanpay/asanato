<?php

namespace App\Containers\BankAccount\Tasks;

use App\Containers\BankAccount\Data\Repositories\BankAccountRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindBankAccountByIdTask extends Task
{

    protected $repository;

    public function __construct(BankAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->find($id);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
