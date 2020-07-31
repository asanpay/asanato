<?php

namespace App\Containers\Wallet\Actions;

use App\Containers\Tx\Enum\TxType;
use App\Containers\Transfer\Exceptions\InsufficientWalletBalanceException;
use App\Containers\Wallet\Exceptions\PayerWalletNotDefinedException;
use App\Containers\Wallet\Models\Wallet;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Support\Facades\DB;
use Tartan\Log\Facades\XLog;

class CreateWalletAction extends Action
{
    public function run(Request $request): Wallet
    {
        $data = $request->sanitizeInput([
            'name',
            'default',
        ]);

        $payerWalletId = $request->payer_wallet_id;

        $user =  $request->user();
        $data['user_id'] = $request->user()->id;

        // get user wallet IDs
        $userWallets = $user->wallets->pluck('id')->all();
        // check whether create fee needed
        $createFeeRequired = (count($userWallets) > 0);


        // check if this is the user's first wallet or not
        if ($createFeeRequired && (empty($payerWalletId) || !in_array($payerWalletId, $userWallets))) {
            throw new PayerWalletNotDefinedException();
        }

        if (count($userWallets) == 0) {
            $data['default'] = true; // first wallet should be the default wallet
        }

        try {
            DB::beginTransaction();

            $wallet = Apiato::call('Wallet@CreateWalletTask', [$data]);

            if ($createFeeRequired && !is_null($payerWalletId)) {
                $createWalletFee = intval(config('wallet-container::fees.wallet.create', 10000));

                if ($createWalletFee > 0) {
                    // check for wallet balance that is responsible for create wallet's fee
                    $payerWallet = Apiato::call('Wallet@FindWalletByIdTask', [$payerWalletId]);

                    // if payer wallet has enough balance to pay the fee
                    if ($payerWallet->getBalance() < $createWalletFee) {
                        throw new InsufficientWalletBalanceException();
                    }

                    // transfer fee from payer wallet to system profit wallet
                    $walletCostProfitWallet = Apiato::call('Wallet@GetProfitWalletTask');

                    // create profit transaction
                    Apiato::call('Transfer@WalletToWalletTransferTask', [
                        $payerWallet->id,
                        $walletCostProfitWallet->id,
                        $createWalletFee,
                        TxType::WALLET_COST,
                        $request->getClientIp(),
                        ['createdWalletId' => $wallet->id]
                    ]);
                }
            }
            DB::commit();

            return $wallet;

        } catch (\Exception $e) {
            Db::rollBack();
            XLog::exception ($e);
            throw $e;
        }
    }
}
