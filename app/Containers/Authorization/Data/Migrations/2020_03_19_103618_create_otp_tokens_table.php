<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtpTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otp_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 6);
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('via', 64)->nullable()->comment('mobile, email, etc')->index();
            $table->string('driver', 20);
            $table->string('reason', 20)->nullable();
            $table->boolean('used')->default(false);
            $table->unsignedInteger('ttl')->default(300)->comment('in seconds');
            $table->unsignedInteger('ip')->comment('requester ip');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('otp_tokens', function ($table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('otp_tokens');
    }
}
