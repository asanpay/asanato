<?php

namespace App\Containers\Transfer\Actions;

use App\Containers\Transfer\Exceptions\InsufficientWalletBalanceException;
use App\Containers\Transfer\Exceptions\WalletDoesNotBelongToUserException;
use App\Containers\Transfer\Exceptions\WalletIsLockedException;
use App\Containers\Transfer\Exceptions\WalletTransferLimitExceededException;
use App\Containers\Tx\Enum\TxType;
use App\Containers\Tx\Models\Tx;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class TransferBetweenMyWalletsAction extends Action
{
    public function run(Request $request): Tx
    {
        $userId = $request->user()->id;

        $data = $request->sanitizeInput([
            'src_wallet_id',
            'dst_wallet_id',
            'amount',
            'description',
            'client_ip',
        ]);

        // check source wallet ownership
        $srcWallet = Apiato::call('Wallet@FindWalletByIdTask', [$data['src_wallet_id']]);

        if ($srcWallet->locked != false) {
            throw new WalletIsLockedException();
        }

        if ($srcWallet->belongsToUser($userId) !== true) {
            throw new WalletDoesNotBelongToUserException('source wallet does not belong to you');
        }

        // check wallet balance
        if (currency($data['amount']) > $srcWallet->getBalance()) {
            throw new InsufficientWalletBalanceException();
        }

        // check wallet transfer limit
        if (currency($data['amount']) > $srcWallet->transfer_limit) {
            throw new WalletTransferLimitExceededException();
        }

        // check destination wallet ownership
        $dstWallet = Apiato::call('Wallet@FindWalletByIdTask', [$data['dst_wallet_id']]);
        if ($dstWallet->belongsToUser($userId) !== true) {
            throw new WalletDoesNotBelongToUserException('destination wallet does not belong to you');
        }

        // create both debtor/creditor transactions
        $tx = Apiato::call('Transfer@WalletToWalletTransferTask', [
            $srcWallet->id,
            $dstWallet->id,
            $data['amount'],
            TxType::TRANSFER,
            // TX meta
            [
                'description' => $data['description'],
                'ip'          => $data['client_ip'],
            ],
        ]);

        return $tx;
    }
}
