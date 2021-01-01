<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTxTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(
            'txes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('wallet_id');
                $table->unsignedBigInteger('user_id')->nullable()->comment('completing async by worker');

                $table->unsignedSmallInteger('type'); // based on TxType::class

                $table->unsignedBigInteger('transaction_id')->nullable(); // transaction document ID
                $table->unsignedBigInteger('withdrawal_id')->nullable(); // withdraw document ID
                $table->unsignedBigInteger('gateway_id')->nullable();

                $table->unsignedBigInteger('creditor')->default(0); // plus
                $table->unsignedBigInteger('debtor')->default(0); // minus

                $table->bigInteger('profit')->default(0); // plus or minus benefits of AsanPay
                $table->BigInteger('balance')->nullable(); //signed +/- باقیمانده

                $table->string('ip');

                $table->jsonb('meta')->default('{}');
                $table->unsignedBigInteger('j_created_at')->nullable();
                $table->dateTimeTz('created_at');
            }
        );

        Schema::table(
            'txes', function ($table) {
                $table->foreign('wallet_id', 'transaction_wallet')->references('id')->on('wallets');
            }
        );

        // add GAP between gateway wallets and user wallets
        $query = 'ALTER SEQUENCE txes_id_seq RESTART WITH 1000000;';
        \Illuminate\Support\Facades\DB::connection()->getPdo()->exec($query);
        $query = 'ALTER TABLE txes ALTER COLUMN ip TYPE inet USING ip::inet;';
        \Illuminate\Support\Facades\DB::connection()->getPdo()->exec($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'txes', function ($table) {
                $table->dropForeign('transaction_wallet');
            }
        );

        Schema::dropIfExists('txes');
    }
}
