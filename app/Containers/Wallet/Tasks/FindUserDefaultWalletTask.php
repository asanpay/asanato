<?php

namespace App\Containers\Wallet\Tasks;

use App\Containers\Wallet\Data\Repositories\WalletRepository;
use App\Containers\Wallet\Models\Wallet;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindUserDefaultWalletTask extends Task
{
    protected WalletRepository $repository;

    public function __construct(WalletRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(int $userId): Wallet
    {
        try {
            $wallet = $this->repository->findWhere(
                [
                'user_id' => $userId,
                'default' => true,
                ]
            );
            if (empty($wallet)) {
                throw new NotFoundException();
            }
            return $wallet->first();
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
