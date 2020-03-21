<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatewaysTable extends Migration
{
    public function up()
    {
        Schema::create('gateways', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('psp_id')->unsigned()->nullable();
            $table->unsignedBigInteger('wallet_id')->comment('Wallet ID that gateway belongs to');

            $table->string('name', 40);
            $table->string('sheba', 26)->nullable();

            $table->boolean('status')->default(true);

            $table->jsonb('properties')->default('{}');

            $table->timestamps();
        });

        Schema::table('gateways', function (Blueprint $table) {
            $table->foreign('psp_id', 'gateway_psp')->references('id')->on('psps');
            $table->foreign('wallet_id', 'connected_wallet')->references('id')->on('wallets')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gateways', function ($table) {
            $table->dropForeign('gateway_psp');
            $table->dropForeign('connected_wallet');
        });


        Schema::drop('gateways');
    }
}
