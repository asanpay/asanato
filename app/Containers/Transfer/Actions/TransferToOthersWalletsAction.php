<?php

namespace App\Containers\Transfer\Actions;

use App\Containers\Otp\Enum\OtpReason;
use App\Containers\Otp\Exceptions\InvalidOtpException;
use App\Containers\Transfer\Exceptions\InsufficientWalletBalanceException;
use App\Containers\Transfer\Exceptions\WalletDoesNotBelongToUserException;
use App\Containers\Transfer\Exceptions\WalletIsLockedException;
use App\Containers\Transfer\Exceptions\WalletTransferLimitExceededException;
use App\Containers\Wallet\Enum\TxType;
use App\Containers\Wallet\Models\Tx;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;
use Google2FA;
use Illuminate\Support\Facades\DB;
use Tartan\Log\Facades\XLog;

class TransferToOthersWalletsAction extends Action
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
            'token',
        ]);

        try {
            DB::beginTransaction();

            if (strlen($request->token) === 6) {
                $status = Apiato::call('Otp@VerifyGoogleAuthCodeTask', [$request->user(), $request->token]);
            } else  if (strlen($request->token) === 4){
                list($status, $message) = Apiato::call('Otp@VerifyOtpAction', [
                    new DataTransporter([
                        'reason' => OtpReason::TRANSFER_MONEY,
                        'mobile' => $request->user()->mobile,
                    ]),
                ]);
            } else {
                throw new InvalidOtpException();
            }

            if ($status !== true) {
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


            DB::commit();

            return $tx;


        } catch (\Exception $e) {
            DB::rollBack();
            XLog::exception($e);

            throw $e;
        }
    }
}
