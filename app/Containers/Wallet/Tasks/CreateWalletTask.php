<?php

namespace App\Containers\Wallet\Tasks;

use App\Containers\Wallet\Data\Repositories\WalletRepository;
use App\Containers\Wallet\Enum\WalletType;
use App\Containers\Wallet\Models\Wallet;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\DB;
use Tartan\Log\Facades\XLog;

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
                DB::update('update wallets set "default" = false where user_id = ?', [$data['user_id']]);
            }

            $wallet = $this->repository->create($data);

            return $wallet;
        } catch (Exception $e) {
            XLog::exception($e);
            throw new CreateResourceFailedException();
        }
    }
}
