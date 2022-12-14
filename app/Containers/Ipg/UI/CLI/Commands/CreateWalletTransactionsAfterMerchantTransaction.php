<?php

namespace App\Containers\Ipg\UI\CLI\Commands;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Transaction\Enum\TransactionProcess;
use App\Containers\Transaction\Enum\TransactionStatus;
use App\Containers\Transaction\Enum\TransactionType;
use App\Containers\Bank\Models\Gateway;
use App\Containers\Transaction\Models\Transaction;
use App\Containers\Tx\Enum\TxType;
use App\Containers\Wallet\Models\Wallet;
use App\Containers\Tx\Models\Tx;
use App\Containers\Tx\Data\Repositories\TxRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Exception;
use Tartan\Log\Facades\XLog;

class CreateWalletTransactionsAfterMerchantTransaction extends Command
{
    const UPTIME_MINUTES = 30;

    /**
     * @var string
     */
    protected $signature = 'ipg:transaction-to-tx';

    /**
     * @var string
     */
    protected $description = 'Create Tx after each gateway transaction accomplishment';

    /**
     * @var Transaction
     */
    protected Transaction $transaction;

    /**
     * @var Wallet
     */
    protected Wallet $wallet;

    /**
     * @var Tx
     */
    protected Tx $tx;

    /**
     * @var TxRepository
     */
    protected TxRepository $txRepo;

    /**
     * @var Gateway
     */
    protected Gateway $gateway;

    /**
     * Create a new command instance.
     *
     * @param Transaction $transaction
     * @param Wallet $wallet
     * @param Tx $tx
     * @param TxRepository $txRepo
     * @param Gateway $gateway
     */
    public function __construct(
        Transaction $transaction,
        Wallet $wallet,
        Tx $tx,
        TxRepository $txRepo,
        Gateway $gateway
    ) {
        parent::__construct();
        $this->transaction = $transaction;
        $this->wallet      = $wallet;
        $this->gateway     = $gateway;
        $this->tx          = $tx;
        $this->txRepo      = $txRepo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $startTime = time();
        $this->warn($this->signature . ' starttime = ' . $startTime);

        do {
            $processableTransaction = $this->transaction
                ->select(
                    [
                        'id',
                        'gateway_id',
                        'merchant_id',
                        'wallet_id',
                        'amount',
                        'payable_amount',
                        'merchant_share',
                        'status',
                        'process',
                        'multiplex',
                        'meta',
                        'ip',
                    ]
                )
                ->processable()
                ->orderBy('id')
                ->get();

            $this->info(sprintf('%d unprocessed transaction(s) found', $processableTransaction->count()));

            foreach ($processableTransaction as $t) {
                $this->info(sprintf('processing transaction id: %d', $t->id));

                try {
                    DB::beginTransaction();
                    if (!empty($t->merchant_id)) {
                        $this->info(json_encode($t->toArray()));
                        // this is a merchant-related transaction
                        $transactionFee = $t->getMerchantFee();
                        $this->info(sprintf("Transaction fee >>> %s", $transactionFee));
                        $involvedWallets = Apiato::call('Ipg@GetInvolvedWalletSharesTask', [$t]);
                        $this->warn(json_encode($involvedWallets));

                        // create incoming wallet Tx
                        Apiato::call('Tx@CreateIncomeTxFromTransactionSubAction', [$t]);

                        // create merchant wallet(s) Txs
                        $this->createMerchantWalletTxs($t, $involvedWallets);

                        // create profit wallet Tx
                        Apiato::call('Tx@CreateProfitTxFromTransactionSubAction', [$t]);
                    } elseif (!empty($t->wallet_id)) {
                        // this is a wallet-related transaction like TopUp
                        // create top-upped wallet transaction
                        $this->info('bypath top-up transaction');
                    } else {
                        throw new Exception(__METHOD__ . ' could not detect wallet transaction type');
                    }

                    // flag gateway transaction as processed
                    $t->process = ($t->status == TransactionStatus::ACCOMPLISHED ?
                        TransactionProcess::ACMP :
                        TransactionProcess::RFNP
                    );
                    $t->save();

                    DB::commit();
                } catch (Exception $e) {
                    $this->error('Exception: ' . $e->getMessage());

                    if ($this->option('verbose')) {
                        $this->line($e->getTraceAsString());
                    }

                    XLog::exception($e, 'emergency');
                    DB::rollBack();
                    exit; // each transaction MUST process
                }
            }
            gc_collect_cycles();
            sleep(self::getLoopDelay());
        } while (time() - $startTime < (self::UPTIME_MINUTES * 60));

        $this->info('processing done!');
    }

    private static function getLoopDelay()
    {
        $hour = date('H');
        if ($hour > 2 && $hour < 6) {
            return 5;
        }

        return 1;
    }

    /**
     * @param Transaction $t
     * @param array $involvedWallets
     *
     * @return bool
     */
    private function createMerchantWalletTxs(Transaction $t, array $involvedWallets): void
    {
        $this->line('creating merchant wallet(s) transaction');

        foreach ($involvedWallets as $w) {
            $merchantTx = [
                'type'           => TxType::MERCHANT,
                'wallet_id'      => $w['id'],
                'user_id'        => $w['owner'],
                'transaction_id' => $t->id,
                'creditor'       => $w['money_share'],
                'gateway_id'     => $t->gateway_id,
                'ip'             => $t->ip,
            ];

            Apiato::call('Tx@CreateTxTask', [$merchantTx]);
        }
    }

    /**
     * @param Transaction $t
     *
     * @return int
     * @throws \App\Exception
     */
    public function getWalletTransactionType(Transaction $t): int
    {
        if (!empty($t->merchant_id)) {
            return TxType::MERCHANT;
        } elseif (!empty($t->wallet_id)) {
            return TxType::TOP_UP;
        } else {
            throw new \App\Exception(__METHOD__ . ' could not detect wallet transaction type');
        }
    }

    /**
     * @param Transaction $t
     *
     * @return void
     */
    private function createGatewayWalletTransaction(Transaction $t): void
    {
        $this->line('creating gateway\'s wallet transaction');

        // find gateway wallet
        $paidGateway = $this->gateway
            ->where('id', $t->gateway_id)
            ->first();

        if (empty($paidGateway)) {
            $this->error('gateway id of the merchant transaction is empty!');
        }

        switch ($t->type) {
            case TransactionType::MERCHANT:
                $profit    = abs($t->payable_amount - $t->merchant_share);
                $userShare = $t->merchant_share;
                break;
            case TransactionType::WALLET_TOPUP:
                $profit    = 0;
                $userShare = $t->payable_amount;
                break;
        }

//        $profit = abs($t->payable_amount - $t->merchant_share);

        $wt                 = new Tx;
        $wt->wallet_id      = $paidGateway->wallet_id;
        $wt->type           = $this->getWalletTransactionType($t);
        $wt->transaction_id = $t->id;
        $wt->raw_amount     = $t->payable_amount;
        $wt->user_share     = $userShare;
        $wt->profit         = $profit; //Financial profit of merchant transaction

        // accomplished

        $wt->debtor = $t->payable_amount;
        $wt->meta   = json_encode(
            [
                'description' => trans('wallet.acmp_inc_gate', ['id' => $t->id]),
            ]
        );

        $wt->save(); //(- TRANSACTION)\\
    }
}
