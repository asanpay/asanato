<?php

namespace App\Containers\Wallet\Tasks;

use App\Containers\Wallet\Data\Repositories\WalletRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllWalletsTask extends Task
{
    protected WalletRepository $repository;

    public function __construct(WalletRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        $wallets = $this->repository->paginate();

        return $wallets;
    }
}
