<?php

namespace App\Containers\Wallet\Tasks;

use App\Containers\Wallet\Data\Repositories\WalletRepository;
use App\Ship\Criterias\Eloquent\ThisUserCriteria;
use App\Ship\Parents\Tasks\Task;

class GetUserWalletsTask extends Task
{

    protected $repository;

    public function __construct(WalletRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($user)
    {
        $this->repository->pushCriteria(new ThisUserCriteria($user->id));
        $wallets =  $this->repository->paginate();

        return $wallets;
    }
}
