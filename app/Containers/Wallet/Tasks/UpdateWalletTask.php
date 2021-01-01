<?php

namespace App\Containers\Wallet\Tasks;

use App\Containers\Wallet\Data\Repositories\WalletRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\DB;
use Tartan\Log\Facades\XLog;

class UpdateWalletTask extends Task
{

    protected $repository;

    public function __construct(WalletRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(int $id, array $data)
    {
        try {
            // remove default flag from all other user wallets
            if (isset($data['default']) && boolval($data['default']) === true) {
                DB::update('UPDATE wallets SET "default" = FALSE WHERE user_id = ?', [$data['user_id']]);
            }

            return $this->repository->update($data, $id);
        } catch (Exception $exception) {
            XLog::exception($exception);
            throw new UpdateResourceFailedException();
        }
    }
}
