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

        $userWallets = $user->wallets->pluck('id')->all();
        $createWageRequired = (count($userWallets) > 0);


        // check if this is the user's first wallet or not
        if ($createWageRequired && (empty($payerWalletId) || !in_array($payerWalletId, $userWallets))) {
            throw new PayerWalletNotDefinedException();
        }

        if (count($userWallets) == 0) {
            $data['default'] = true; // first wallet should be the default wallet
        }


        try {
            DB::beginTransaction();

            $wallet = Apiato::call('Wallet@CreateWalletTask', [$data]);

            if ($createWageRequired && !is_null($payerWalletId)) {
                $createWalletWage = intval(config('wallet-container::wages.wallet.create', 10000));

                if ($createWalletWage > 0) {
                    // check for wallet balance that is responsible for create wallet's wage
                    $payerWallet = Apiato::call('Wallet@FindWalletByIdTask', [$payerWalletId]);

                    if ($payerWallet->getBalance() < $createWalletWage) {
                        throw new InsufficientWalletBalanceException();
                    }

                    $walletConstProfitWallet = Apiato::call('Wallet@GetCreateWalletProfitWalletTask');

                    Apiato::call('Transfer@WalletToWalletTransferTask', [
                        $payerWallet->id,
                        $walletConstProfitWallet->id,
                        $createWalletWage,
                        TxType::WALLET_COST,
                        $data['client_ip'],
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
