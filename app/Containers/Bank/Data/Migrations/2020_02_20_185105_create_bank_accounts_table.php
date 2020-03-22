<?php

use App\Containers\Bank\Enum\BankAccountStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('owner_first_name', 30)->nullable();
            $table->string('owner_last_name', 30)->nullable();

            $table->string('sheba', 26)->nullable();
            $table->string('card_number', 16)->nullable();

            $table->unsignedInteger('user_id')->comment('user ID that bank account belongs to');

            $table->enum('status', BankAccountStatus::toArray())->default(BankAccountStatus::PENDING);
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->timestamps();
        });

        Schema::table('bank_accounts', function ($table) {
            $table->foreign('bank_id', 'bank_account_bank')->references('id')->on('banks');
            $table->foreign('user_id', 'bank_account_user')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bank_accounts', function ($table) {
            $table->dropForeign('bank_account_bank');
            $table->dropForeign('bank_account_user');
        });

        Schema::dropIfExists('bank_accounts');
    }
}
