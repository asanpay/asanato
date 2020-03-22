<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Containers\Wallet\Enum\WagePolicy;
use App\Containers\Wallet\Enum\WageBy;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->unsigned()->nullable();

            $table->string('api_key', 64)->unique();

            $table->boolean('status')->default(true);

            $table->enum('wage_policy', WagePolicy::toArray())->default(WagePolicy::PERCENT);
            $table->unsignedDecimal('wage_value')->default(1);
            $table->enum('wage_by', WageBy::toArray())->default(WageBy::MERCHANT);
            $table->unsignedInteger('wage_max')->default(40000)->comment('Rial');

            $table->string('name', 64)->comment('Merchant`s name to show on gateway page');
            $table->string('domain', 255)->comment('Merchant`s main domain');

            $table->string('ip_access')->nullable()->comment('comma separated ip addresses');

            $table->timestamps();
        });

        Schema::table('merchants', function (Blueprint $table) {
            $table->foreign('user_id', 'merchant_user')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchants', function ($table) {
            $table->dropForeign('merchant_user');
        });

        Schema::dropIfExists('merchants');
    }
}
