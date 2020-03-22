<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Ship\Enum\LocationType;

class CreateLocationsTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {

            $table->increments('id');
            $table->string('path', 64);
            $table->enum('type', LocationType::toArray());
            $table->integer('priority')->default(0);
            $table->jsonb('meta')->default('{}');

            $table->timestamps();

        });

        $query = 'ALTER TABLE locations ALTER COLUMN path TYPE "ltree" USING "path"::"ltree";';
        \Illuminate\Support\Facades\DB::connection()->getPdo()->exec($query);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('locations');
    }
}

