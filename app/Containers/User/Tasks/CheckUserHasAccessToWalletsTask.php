<?php
declare(strict_types=1);

namespace App\Containers\User\Tasks;

use App\Containers\Wallet\Models\SharedWallet;
use App\Containers\Wallet\Models\Wallet;
use App\Ship\Parents\Tasks\Task;

class CheckUserHasAccessToWalletsTask extends Task
{
    public function run(int $userId, array $walletIds): bool
    {
        $ownedWallets = Wallet::select('id')
            ->where('user_id', $userId)
            ->get()
            ->pluck('id')
            ->toArray();

        $shareWallets =  SharedWallet::select('wallet_id')
            ->where('user_id', $userId)
            ->get()
            ->pluck('wallet_id')
            ->toArray();

        $allAuthorizedWallets = array_merge($ownedWallets, $shareWallets);

        return empty(array_diff($walletIds, $allAuthorizedWallets));
    }
}
