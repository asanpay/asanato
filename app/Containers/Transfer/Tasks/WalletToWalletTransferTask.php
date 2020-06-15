<?php

namespace App\Containers\Transfer\Tasks;

use App\Containers\Tx\Data\Repositories\TxRepository;
use App\Containers\Tx\Enum\TxType;
use App\Containers\Transfer\Exceptions\InsufficientWalletBalanceException;
use App\Containers\Wallet\Exceptions\InvalidTransferAmountException;
use App\Containers\Transfer\Exceptions\WalletTransferFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use App\Containers\Tx\Models\Tx;
use Illuminate\Support\Facades\DB;
use Tartan\Log\Facades\XLog;

class WalletToWalletTransferTask extends Task
{

    private TxRepository $TxRepository;

    public function __construct(TxRepository $TxRepository)
    {
        $this->TxRepository = $TxRepository;
    }

    /**
     * @param int $sourceWallet
     * @param int $destinationWallet
     * @param int $amount
     * @param int $reason
     * @param string $ipAddress
     * @param array $meta
     *
     * @return bool
     * @throws InvalidTransferAmountException
     */
    public function run(
        int $sourceWallet,
        int $destinationWallet,
        int $amount,
        int $reason,
        string $ipAddress,
        array $meta = []
    ): Tx {
        if ($amount <= 0) {
            throw new InvalidTransferAmountException();
        }

        XLog::debug(__METHOD__, func_get_args());

        $tx = null;

        DB::transaction(function () use ($sourceWallet, $destinationWallet, $amount, $reason, $ipAddress, $meta, &$tx) {

            $meta = $this->prepareExtraFor($reason, $meta);

            // source wallet
            $source = DB::table('wallets')
                ->where('id', $sourceWallet);

            // prevent from spending more than wallet balance
            $source->whereRaw("balance - locked_balance >= {$amount}");

            $updatedRow = $source->update(['balance' => DB::raw("balance - {$amount}")]);

            if ($updatedRow < 1) {
                throw new InsufficientWalletBalanceException();
            }

            // destination wallet

            DB::table('wallets')
                ->where('id', $destinationWallet)
                ->update(['balance' => DB::raw("balance + {$amount}")]);

            // create transfer transaction in wallet transactions field
            $tx = $this->createWalletTransferTransactions($sourceWallet, $destinationWallet, $amount, $ipAddress,
                $meta);
        });

        return $tx;
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
            case TxType::WALLET_COST:
            {
                if (!isset($meta['createdWalletId'])) {
                    throw new NotFoundException('createdWalletId is required');
                }

                $meta ['description'] = __('wallet.create_wallet_wage', ['id' => $meta['createdWalletId']]);
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
        string $ipAddress,
        array $meta = []
    ): Tx {

        XLog::debug(__METHOD__, func_get_args());

        // debtor transaction
        $debtorTransactions             = $this->TxRepository->makeModel();
        $debtorTransactions->wallet_id  = $sourceWalletId;
        $debtorTransactions->type       = TxType::TRANSFER;
        $debtorTransactions->debtor     = $amount;
        $debtorTransactions->ip_address = $ipAddress;
        $debtorTransactions->meta       = json_encode($meta);

        $t1 = $debtorTransactions->save();

        XLog::debug(__METHOD__ . " T1 = {$t1}");

        // creditor transaction
        $creditorTransaction            = $this->TxRepository->makeModel();
        $creditorTransaction->wallet_id = $destinationWalletId;
        $creditorTransaction->type      = TxType::TRANSFER;
        $creditorTransaction->creditor  = $amount;
        $creditorTransaction->meta      = json_encode($meta);
        $debtorTransactions->ip_address = $ipAddress;
        $creditorTransaction->double_id = $debtorTransactions->id;

        $t2 = $creditorTransaction->save();

        $debtorTransactions->double_id = $creditorTransaction->id;
        $t1                            = $debtorTransactions->save();

        XLog::debug(__METHOD__ . " T2 = {$t2}");

        if (($t1 && $t2 !== true)) {
            throw (new WalletTransferFailedException())
                ->overrideCustomData(['problem' => 'could not create wallet transfer transactions']);
        }

        return $debtorTransactions;
    }

}
