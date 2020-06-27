<?php

namespace App\Containers\BankAccount\Tasks;

use App\Containers\BankAccount\Data\Repositories\BankAccountRepository;
use App\Ship\Parents\Tasks\Task;

class GetBankAccountsTask extends Task
{
    protected BankAccountRepository $repository;

    public function __construct(BankAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return  $this->repository->paginate();
    }
}
