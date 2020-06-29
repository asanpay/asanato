<?php

use App\Containers\BankAccount\Enum\BankAccountStatus;
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
            $table->unsignedInteger('user_id')->comment('user ID that bank account belongs to');
            $table->unsignedBigInteger('bank_id')->nullable();

            $table->string('iban', 24)->nullable();

            $table->string('ip_address');

            $table->enum('status', BankAccountStatus::toArray())->default(BankAccountStatus::PENDING);
            $table->boolean('default')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('bank_accounts', function ($table) {
            $table->foreign('bank_id', 'bank_account_bank')->references('id')->on('banks');
            $table->foreign('user_id', 'bank_account_user')->references('id')->on('users')->onDelete('restrict');
        });

        $query = 'ALTER TABLE bank_accounts ALTER COLUMN ip_address type inet USING ip_address::inet;';
        \Illuminate\Support\Facades\DB::connection()->getPdo()->exec($query);
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
