<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Create2faTokenTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('two_fa_tokens', function (Blueprint $table) {

          $table->bigIncrements('id');
          $table->string('code', 6);
          $table->integer('user_id')->unsigned();
          $table->boolean('used')->default(false);
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('two_fa_tokens');
    }
}
