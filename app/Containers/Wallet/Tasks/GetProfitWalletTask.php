<?php

namespace App\Containers\Wallet\Tasks;

use App\Containers\Wallet\Data\Repositories\WalletRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class GetProfitWalletTask extends Task
{

    protected $repository;

    public function __construct(WalletRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        try {
            return $this->repository->makeModel()->getCreateWalletProfitWallet();
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
