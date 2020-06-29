<?php

namespace App\Containers\BankAccount\Tasks;

use App\Containers\BankAccount\Data\Repositories\BankAccountRepository;
use App\Containers\BankAccount\Exceptions\CouldNotDeleteAccountException;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Tartan\Log\Facades\XLog;

class DeleteBankAccountTask extends Task
{
    protected BankAccountRepository $repository;

    public function __construct(BankAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        $account = $this->repository->find($id);

        if ($account->isApproved()) {
            throw new CouldNotDeleteAccountException();
        }

        if ($account->isDefault()) {
            throw new CouldNotDeleteAccountException('Could not delete default account');
        }

        try {
            return $this->repository->delete($id);
        }
        catch (Exception $exception) {
            XLog::exception($exception);
            throw new DeleteResourceFailedException();
        }
    }
}
