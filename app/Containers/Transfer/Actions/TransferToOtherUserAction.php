<?php

namespace App\Containers\Transfer\Actions;

use App\Containers\Otp\Enum\OtpReason;
use App\Containers\Otp\Exceptions\InvalidOtpException;
use App\Containers\Transfer\Exceptions\InsufficientWalletBalanceException;
use App\Containers\Transfer\Exceptions\WalletDoesNotBelongToUserException;
use App\Containers\Transfer\Exceptions\WalletIsLockedException;
use App\Containers\Transfer\Exceptions\WalletTransferLimitExceededException;
use App\Containers\Tx\Enum\TxType;
use App\Containers\Tx\Models\Tx;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;;
use Illuminate\Support\Facades\DB;
use Tartan\Log\Facades\XLog;

class TransferToOtherUserAction extends Action
{
    public function run(Request $request): Tx
    {
        $userId = $request->user()->id;

        $data = $request->sanitizeInput([
            'src_wallet_id',
            'dst_user_id',
            'amount',
            'description',
            'client_ip',
            'token',
        ]);

        try {
            DB::beginTransaction();

            $otpValidity = Apiato::call('Otp@VerifyOtpAction', [$request->user(), $request->token, OtpReason::TRANSFER_MONEY]);

            if ($otpValidity !== true) {
                throw new InvalidOtpException();
            }

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

            // destination wallet
            $dstWallet = Apiato::call('Wallet@FindUserDefaultWalletTask', [$data['dst_user_id']]);

            // create both debtor/creditor transactions
            $tx = Apiato::call('Transfer@WalletToWalletTransferTask', [
                $srcWallet->id,
                $dstWallet->id,
                $data['amount'],
                TxType::TRANSFER,
                $request->getClientIp(),
                // TX meta
                [
                    'description' => $data['description'],
                ],
            ]);


            DB::commit();

            return $tx;


        } catch (\Exception $e) {
            DB::rollBack();
            XLog::exception($e);

            throw $e;
        }
    }
}
