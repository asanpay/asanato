<?php

namespace App\Containers\Transfer\Traits;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Otp\Enum\OtpReason;
use App\Containers\Otp\Exceptions\InvalidOtpException;
use App\Containers\Transfer\Exceptions\InsufficientWalletBalanceException;
use App\Containers\Transfer\Exceptions\WalletDoesNotBelongToUserException;
use App\Containers\Transfer\Exceptions\WalletIsLockedException;
use App\Containers\Transfer\Exceptions\WalletTransferLimitExceededException;
use App\Containers\Tx\Enum\TxType;
use App\Containers\Tx\Models\Tx;
use App\Containers\User\Models\User;
use Illuminate\Support\Facades\DB;
use Tartan\Log\Facades\XLog;

trait TransferToOthersWalletTrait
{
    public function transfer(
        User $user,
        int $srcWalletId,
        int $dstWalletId,
        int $amount,
        string $description,
        string $clientIp,
        string $token
    ): Tx {
        try {
            DB::beginTransaction();

            $otpValidity = Apiato::call(
                'Otp@VerifyOtpAction',
                [$user, $token, OtpReason::TRANSFER_MONEY]
            );

            if ($otpValidity !== true) {
                throw new InvalidOtpException();
            }

            // check source wallet ownership
            $srcWallet = Apiato::call(
                'Wallet@FindWalletByIdTask',
                [$srcWalletId]
            );

            if ($srcWallet->locked != false) {
                throw new WalletIsLockedException();
            }

            if ($srcWallet->belongsToUser($user->id) !== true) {
                throw new WalletDoesNotBelongToUserException('source wallet does not belong to you');
            }

            // check wallet balance
            if (currency($amount) > $srcWallet->getBalance()) {
                throw new InsufficientWalletBalanceException();
            }

            // check wallet transfer limit
            if (currency($amount) > $srcWallet->transfer_limit) {
                throw new WalletTransferLimitExceededException();
            }

            // destination wallet
            $dstWallet = Apiato::call(
                'Wallet@FindWalletByIdTask',
                [$dstWalletId]
            );

            // create both debtor/creditor transactions
            $tx = Apiato::call(
                'Transfer@WalletToWalletTransferTask',
                [
                    $srcWallet->id,
                    $dstWallet->id,
                    $amount,
                    TxType::TRANSFER,
                    $clientIp,
                    // TX meta
                    [
                        'description' => $description,
                    ],
                ]
            );


            DB::commit();

            return $tx;
        } catch (\Exception $e) {
            DB::rollBack();
            XLog::exception($e);

            throw $e;
        }
    }
}
