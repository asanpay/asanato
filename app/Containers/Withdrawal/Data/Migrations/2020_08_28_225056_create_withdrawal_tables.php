<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use App\Containers\Withdrawal\Enum\WithdrawalStatus;

class CreateWithdrawalTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {

            $table->increments('id');

            $table->unsignedBigInteger('amount');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('wallet_id');
            $table->unsignedBigInteger('bank_account_id');
            $table->unsignedSmallInteger('status')->default(WithdrawalStatus::PENDING);
            $table->string('description')->nullable();
            $table->uuid('uid')->unique();
            $table->string('institution_id', 40)->nullable();
            $table->string('payment_id', 40)->nullable();
            $table->string('tracking_id', 40)->nullable()->comment('bank tracking id');
            $table->string('ip');
            $table->unsignedInteger('fee');
            $table->jsonb('meta')->default('{}');

            $table->unsignedBigInteger('j_created_at')->nullable();
            $table->dateTime('processed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('withdrawals', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')->onDelete('restrict');
            $table->foreign('wallet_id')
                ->references('id')->on('wallets')->onDelete('restrict');
            $table->foreign('bank_account_id')
                ->references('id')->on('bank_accounts')->onDelete('restrict');
        });


        $query = 'ALTER SEQUENCE withdrawals_id_seq RESTART WITH 1000111111;';
        \Illuminate\Support\Facades\DB::connection()->getPdo()->exec($query);

        $query = 'ALTER TABLE txes ALTER COLUMN ip TYPE inet USING ip::inet;';
        \Illuminate\Support\Facades\DB::connection()->getPdo()->exec($query);

    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('withdrawals', function ($table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['wallet_id']);
            $table->dropForeign(['bank_account_id']);
        });

        Schema::dropIfExists('withdraws');
    }
}
