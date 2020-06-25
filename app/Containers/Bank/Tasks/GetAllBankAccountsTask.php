<?php

namespace App\Containers\Bank\Tasks;

use App\Containers\Bank\Data\Repositories\BankAccountRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllBankAccountsTask extends Task
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
