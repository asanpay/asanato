<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateWlletBalanceAfterTxInsetion extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = file_get_contents(__DIR__ . '/../Triggers/update_wallet_balance_after_tx_insertion.sql');
        DB::connection()->getPdo()->exec($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $sql = 'DROP TRIGGER IF EXISTS update_wallet_balance_after_tx_insertion on "txes";';
        DB::connection()->getPdo()->exec($sql);

        $sql = "DROP FUNCTION IF EXISTS do_update_wallet_balance_after_tx_insertion();";
        DB::connection()->getPdo()->exec($sql);
    }
}
