<?php

namespace App\Containers\Wallet\Tasks;

use App\Containers\Wallet\Data\Repositories\WalletRepository;
use App\Containers\Wallet\Exceptions\CouldNotDeleteWalletWithBalanceException;
use App\Containers\Wallet\Exceptions\WalletNotFoundException;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Tartan\Log\Facades\XLog;

class DeleteWalletTask extends Task
{

    protected $repository;

    public function __construct(WalletRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        $wallet = $this->repository->find($id);

        if (empty($wallet)) {
            throw new WalletNotFoundException();
        }
        if ($wallet->hasBalance()) {
            throw new CouldNotDeleteWalletWithBalanceException();
        }
        if ($wallet->isDefault()) {
            throw new CouldNotDeleteWalletWithBalanceException('could not delete default wallet');
        }

        try {
            return $this->repository->delete($id);
        } catch (Exception $e) {
            XLog::exception($e);
            throw new DeleteResourceFailedException();
        }
    }
}
