<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * add init db scripts like Postgres extension activation
 * added some sample
 *
 * Class InitDb
 */
class InitDb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $dbName = Db::connection()->getDatabaseName();
        $timezone = config('app.timezone');

        DB::connection()->getPdo()->exec("SET TIME ZONE '".$timezone."'");
        DB::connection()->getPdo()->exec("ALTER DATABASE {$dbName} SET timezone TO '".$timezone."'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
