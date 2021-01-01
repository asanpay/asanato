<?php


namespace App\Containers\Wallet\UI\CLI\Commands;

use App\Ship\Parents\Commands\ConsoleCommand;
use App\Containers\Tx\Enum\TxType;
use App\Containers\Tx\Models\Tx;
use Illuminate\Support\Facades\DB;
use Tartan\Zaman\Facades\Zaman;

class UpdateTxBalance extends ConsoleCommand
{
    const UPTIME_MINUTES = 30;

    /**
     * @var string
     */
    protected $signature = 'wallets:update-balance';

    /**
     * @var string
     */
    protected $description = 'update balance field of each wallet transaction';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $startTime = time();
        $this->warn($this->signature . ' starttime = '. $startTime);

        do {
            $walletTransactions = Tx::with('wallet')
                ->whereNull('balance')
                ->orderBy('id')
                ->limit(100)
                ->get();

            $this->info($this->signature . ' rows = '. $walletTransactions->count());

            if ($walletTransactions->count() < 1) {
                sleep(1);
            }

            foreach ($walletTransactions as $transaction) {
                DB::transaction(
                    function () use ($transaction) {
                        $previousTransaction = Tx::where('id', '<', $transaction->id)
                        ->where('wallet_id', $transaction->wallet_id)
                        ->orderBy('id', 'DESC')
                        ->first();

                        if (!$previousTransaction) {
                            // no previous transaction exists
                            $transaction->balance = $transaction->creditor - $transaction->debtor;
                        } else {
                            $transaction->balance = $previousTransaction->balance +
                                $transaction->creditor - $transaction->debtor;
                        }

                        $transaction->j_created_at = Zaman::gtoj($transaction->created_at, 'yyyyMMddHHmmss', 'en');
                        $transaction->save();

                        // update wallet balance
                        if ($transaction->type == TxType::MERCHANT) {
                            // update wallet balance
                            $transaction->wallet->update(
                                [
                                    'balance' => DB::raw("balance + {$transaction->creditor} - {$transaction->debtor}"),
                                ]
                            );
                            $this->info(
                                "wallet $transaction->wallet_id balance updated to {$transaction->wallet->balance}"
                            );
                        }

                        $this->info("transaction $transaction->id balance updated to {$transaction->balance}");
                    }
                );

                usleep(100);
            }
            gc_collect_cycles();
            sleep(1);
        } while (time() - $startTime < (self::UPTIME_MINUTES * 60));
    }
}
