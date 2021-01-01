<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'banks', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 40);
                $table->string('slug', 40);
                $table->string('color', 9)->default('#F5F5F3');
                $table->boolean('is_active')->default(true);

                $table->timestamps();
                $table->unique(['name']);
                $table->unique(['slug']);
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
        Schema::dropIfExists('banks');
    }
}
