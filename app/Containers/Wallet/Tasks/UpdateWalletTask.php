<?php

namespace App\Containers\Wallet\Tasks;

use App\Containers\Wallet\Data\Repositories\WalletRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateWalletTask extends Task
{

    protected $repository;

    public function __construct(WalletRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            return $this->repository->update($data, $id);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
