<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Enum\WalletType;
use App\Enum\WalletStatus;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('user_id')->comment('user ID that wallet belongs to');

            $table->enum('type', WalletType::toArray());
            $table->enum('status', WalletStatus::toArray())->default(WalletStatus::ACTIVE);
            $table->boolean('belongs_to_app')->default('false')
                ->comment('whether wallet belongs to the application or not');


            $table->string('name', 64);
            $table->unsignedBigInteger('balance')->default(0);
            $table->unsignedBigInteger('locked_balance')->default(0);
            $table->string('locked_reason', 255)->nullable();
            $table->unsignedBigInteger('transfer_limit')->nullable();

            $table->boolean('default')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('wallets', function (Blueprint $table) {
            $table->foreign('user_id', 'wallet_user')->references('id')->on('users')->onDelete('restrict');
        });

        // add GAP between gateway wallets and user wallets
        $query = 'ALTER SEQUENCE wallets_id_seq RESTART WITH 2000;';
        \Illuminate\Support\Facades\DB::connection()->getPdo()->exec($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wallets', function ($table) {
            $table->dropForeign('wallet_user');
        });

        Schema::dropIfExists('wallets');
    }
}
