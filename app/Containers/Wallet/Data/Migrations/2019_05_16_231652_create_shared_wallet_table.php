<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSharedWalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shared_wallets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('wallet_id');
            $table->boolean('accepted')->default(false)
                ->comment('whether accepted by target account');
            $table->timestamps();
        });

        Schema::table('shared_wallets', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shared_wallets', function ($table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['wallet_id']);
        });

        Schema::dropIfExists('shared_wallets');
    }
}
