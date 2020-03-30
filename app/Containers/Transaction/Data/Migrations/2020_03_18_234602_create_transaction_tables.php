<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionTables extends Migration
{

    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            // transaction IDs
            $table->bigIncrements('id');
            $table->string('flag', 4)->index('uniq_flag');

            $table->unsignedSmallInteger('type')->default(\App\Containers\Transaction\Enum\TransactionType::MERCHANT);

            // transaction owner
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('merchant_id')->nullable()->comment('uses for merchant transaction');
            $table->unsignedBigInteger('wallet_id')->nullable()->comment('uses for wallet charge transaction');

            //request parameters
            $table->unsignedBigInteger('amount')->comment('amount that merchant requested to gateway');
            $table->unsignedBigInteger('payable_amount')->comment('amount that customer should pay on gateway');
            $table->unsignedBigInteger('merchant_share')->nullable()->comment('amount that should pay to merchant after checkout');

            $table->string('invoice_number', 32)->nullable()->comment('invoice number at merchant side');
            $table->string('callback_url', 255);
            $table->string('description',255)->nullable();

            // payer information
            $table->string('payer_name', 32)->nullable()->comment('payer name');
            $table->string('payer_mobile', 11)->nullable()->comment('payer mobile');
            $table->string('payer_email', 40)->nullable()->comment('payer email');

            // gateway parameters
            $table->unsignedInteger('psp_id')->unsigned()->nullable();
            $table->unsignedInteger('gateway_id')->unsigned()->nullable();
            $table->unsignedBigInteger('gateway_order_id')->nullable();
            $table->string('gateway_token', 40)->nullable();  // before gotogate
            $table->string('gateway_ref_id', 50)->nullable(); // after gotogate
            $table->jsonb('gateway_callback_params')->default('{}');

            // psp gateway actions
            $table->unsignedBigInteger('j_created_at')->nullable();
            $table->dateTime('accomplished_at')->nullable();
            $table->unsignedBigInteger('j_accomplished_at')->nullable();
            $table->dateTime('refunded_at')->nullable();

            $table->unsignedSmallInteger('status')->default(\App\Containers\Transaction\Enum\TransactionStatus::NEW);
            $table->unsignedSmallInteger('process')->default(\App\Containers\Transaction\Enum\TransactionProcess::NONE);

            $table->jsonb('meta')->default('{}');

            $table->unsignedInteger('day_of_year')->comment('created at which the day of the year');
            $table->timestamps();
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('user_id', 'transaction_user')->references('id')->on('users');
            $table->foreign('merchant_id', 'transaction_merchant')->references('id')->on('merchants');
            $table->foreign('gateway_id', 'transaction_gateway')->references('id')->on('gateways');
        });

        // add GAP between gateway wallets and user wallets
        $query = 'ALTER SEQUENCE transactions_id_seq RESTART WITH 1000000;';
        \Illuminate\Support\Facades\DB::connection()->getPdo()->exec($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function ($table) {
            $table->dropForeign('transaction_user');
            $table->dropForeign('transaction_merchant');
            $table->dropForeign('transaction_gateway');
        });

        Schema::dropIfExists('transactions');
    }
}
