<?php

namespace App\Containers\Wallet\Tasks;

use App\Containers\Wallet\Data\Repositories\WalletRepository;
use App\Containers\Wallet\Models\Wallet;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class GetSystemWalletTask extends Task
{
    protected WalletRepository $repository;

    public function __construct(WalletRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(string $type): Wallet
    {
        try {
            $wallet = $this->repository->findWhere(
                [
                'type'           => $type,
                'user_id'        => config('settings.app_user_id'),
                'belongs_to_app' => true,
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
