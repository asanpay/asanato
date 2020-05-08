<?php

namespace App\Containers\Wallet\Tasks;

use App\Containers\Wallet\Data\Repositories\WalletTransactionRepository;
use App\Containers\Wallet\Enum\WalletTransactionType;
use App\Containers\Wallet\Exceptions\InsufficientWalletBalanceException;
use App\Containers\Wallet\Exceptions\InvalidTransferAmountException;
use App\Containers\Wallet\Exceptions\WalletTransferFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\DB;
use Tartan\Log\Facades\XLog;

class WalletToWalletTransferTask extends Task
{

    private WalletTransactionRepository $walletTransactionRepository;

    public function __construct(WalletTransactionRepository $walletTransactionRepository)
    {
        $this->walletTransactionRepository = $walletTransactionRepository;
    }

    /**
     * @param int $sourceWallet
     * @param int $destinationWallet
     * @param int $amount
     * @param int $reason
     * @param array $meta
     * @param bool $forced
     *
     * @return bool
     * @throws InvalidTransferAmountException
     */
    public function run(
        int $sourceWallet,
        int $destinationWallet,
        int $amount,
        int $reason,
        array $meta = [],
        bool $forced = false
    ): bool {
        if ($amount <= 0) {
            throw new InvalidTransferAmountException();
        }

        XLog::debug(__METHOD__, func_get_args());

        DB::transaction(function () use ($sourceWallet, $destinationWallet, $amount, $reason, $forced, $meta) {

            $meta = $this->prepareExtraFor($reason, $meta);

            // source wallet
            $source = DB::table('wallets')
                ->where('id', $sourceWallet);


            // prevent transfer amount bigger than current effective wallet balance from source wallet
            if ($forced !== true) {
                $source->whereRaw("balance - locked_balance >= {$amount}");
            }

            $updatedRow = $source->update(['balance' => DB::raw("balance - {$amount}")]);

            if ($updatedRow < 1) {
                throw new InsufficientWalletBalanceException();
            }

            // destination wallet

            DB::table('wallets')
                ->where('id', $destinationWallet)
                ->update(['balance' => DB::raw("balance + {$amount}")]);

            // create transfer transaction in wallet transactions field
            $this->createWalletTransferTransactions($sourceWallet, $destinationWallet, $amount, $meta);
        });

        return true;
    }

    /**
     * @param int $reason
     * @param array $meta
     *
     * @return array
     * @throws NotFoundException
     */
    private function prepareExtraFor(int $reason, array $meta = [])
    {
        // @todo complete all type of wallet transactions
        switch ($reason) {
            case WalletTransactionType::WALLET_COST:
            {
                if (!isset($meta['createdWalletId'])) {
                    throw new NotFoundException('createdWalletId is required');
                }

                $meta ['description'] = __('wallet.create_wallet_wage', ['id' => $meta['createdWalletId']]);
                break;
            }

            case WalletTransactionType::TRANSFER:
            {

                break;
            }
        }
        $meta['xid'] = resolve('xTrackId');

        return $meta;
    }

    private function createWalletTransferTransactions(
        int $sourceWalletId,
        int $destinationWalletId,
        int $amount,
        array $meta = []
    ): bool {

        XLog::debug(__METHOD__, func_get_args());

        // debtor transaction
        $debtorTransactions            = $this->walletTransactionRepository->makeModel();
        $debtorTransactions->wallet_id = $sourceWalletId;
        $debtorTransactions->type      = WalletTransactionType::TRANSFER;
        $debtorTransactions->debtor    = $amount;
        $debtorTransactions->meta      = json_encode($meta);

        $t1 = $debtorTransactions->save();

        XLog::debug(__METHOD__ . " T1 = {$t1}");

        // creditor transaction
        $creditorTransaction            = $this->walletTransactionRepository->makeModel();
        $creditorTransaction->wallet_id = $destinationWalletId;
        $creditorTransaction->type      = WalletTransactionType::TRANSFER;
        $creditorTransaction->creditor  = $amount;
        $creditorTransaction->meta      = json_encode($meta);
        $creditorTransaction->double_id = $debtorTransactions->id;

        $t2 = $creditorTransaction->save();

        $debtorTransactions->double_id = $creditorTransaction->id;
        $t1 = $debtorTransactions->save();

        XLog::debug(__METHOD__ . " T2 = {$t2}");

        if (($t1 && $t2 !== true)) {
            throw (new WalletTransferFailedException())
                ->overrideCustomData(['problem' => 'could not create wallet transfer transactions']);
        }
        return true;
    }

}
