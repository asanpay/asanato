<?php

namespace App\Containers\Wallet\Tasks;

use App\Containers\Wallet\Data\Repositories\WalletRepository;
use App\Containers\Wallet\Enum\WalletType;
use App\Containers\Wallet\Models\Wallet;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateWalletTask extends Task
{

    protected $repository;

    public function __construct(WalletRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data): Wallet
    {
        try {
            $data['type'] = WalletType::USER;

            $makeDefault = boolval($data['default'] ?? false);

            // remove default flag from all other user wallets
            if ($makeDefault === true) {
                $this->repository->update(['default' => false], $data['user_id']);
            }

            $wallet = $this->repository->create($data);

            return $wallet;
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
