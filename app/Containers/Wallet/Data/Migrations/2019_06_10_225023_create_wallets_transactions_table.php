<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletsTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('wallet_id');

            $table->unsignedSmallInteger('type'); // based on WalletTransactionType::class

            $table->unsignedBigInteger('transaction_id')->nullable(); // transaction/withdraw/transfer document ID
            $table->unsignedBigInteger('double_id')->nullable();

            $table->unsignedBigInteger('raw_amount')->default(0)->comment('transaction raw amount');
            $table->unsignedBigInteger('user_share')->default(0)->comment('user share of the transaction');

            $table->unsignedBigInteger('creditor')->default(0); // plus
            $table->unsignedBigInteger('debtor')->default(0); // minus

            $table->bigInteger('profit')->default(0); // plus or minus benefits of AsanPay
            $table->BigInteger('balance')->nullable(); //signed +/- باقیمانده

            $table->jsonb('meta')->default('{}');
            $table->unsignedBigInteger('j_created_at')->nullable();
            $table->timestamps();
        });

        Schema::table('wallets_transactions', function ($table) {
            $table->foreign('wallet_id', 'transaction_wallet')->references('id')->on('wallets');
        });

        // add GAP between gateway wallets and user wallets
        $query = 'ALTER SEQUENCE wallets_transactions_id_seq RESTART WITH 1000000;';
        \Illuminate\Support\Facades\DB::connection()->getPdo()->exec($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wallets_transactions', function ($table) {
            $table->dropForeign('transaction_wallet');
        });

        Schema::dropIfExists('wallets_transactions');
    }
}
