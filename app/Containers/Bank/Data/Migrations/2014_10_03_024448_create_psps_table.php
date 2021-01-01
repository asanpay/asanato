<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePspsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'psps', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 40);
                $table->string('slug', 40);
                $table->boolean('is_active')->default(false);
                $table->boolean('is_bank')->default(false);
                $table->boolean('refund_support')->default(false);
                $table->boolean('app_gate')->default(false);

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
        Schema::dropIfExists('psps');
    }
}
