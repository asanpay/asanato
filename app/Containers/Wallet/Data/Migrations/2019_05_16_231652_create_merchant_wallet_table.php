<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// @codingStandardsIgnoreLine
class CreateMerchantWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'merchant_wallet',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedBigInteger('merchant_id');
                $table->unsignedBigInteger('wallet_id');
                $table->float('share', 2);
            }
        );

        Schema::table(
            'merchant_wallet',
            function (Blueprint $table) {
                $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('restrict');
                $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('restrict');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'merchant_wallet',
            function ($table) {
                $table->dropForeign(['merchant_id']);
                $table->dropForeign(['wallet_id']);
            }
        );

        Schema::dropIfExists('merchant_wallet');
    }
}
