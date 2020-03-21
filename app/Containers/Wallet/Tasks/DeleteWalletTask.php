<?php

namespace App\Containers\Wallet\Tasks;

use App\Containers\Wallet\Data\Repositories\WalletRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteWalletTask extends Task
{

    protected $repository;

    public function __construct(WalletRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->delete($id);
        }
        catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
