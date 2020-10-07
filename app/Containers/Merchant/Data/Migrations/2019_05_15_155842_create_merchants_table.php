<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Containers\Merchant\Enum\FeePolicy;
use App\Containers\Merchant\Enum\FeeBy;
use App\Containers\Merchant\Enum\Progress;

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

            $table->string('code', 64)->unique();

            $table->boolean('status')->default(false);
            $table->enum('progress', Progress::toArray())->default(Progress::CREATED);

            $table->enum('fee_policy', FeePolicy::toArray())->default(FeePolicy::PERCENT);
            $table->unsignedDecimal('fee_value')->default(1);
            $table->enum('fee_by', FeeBy::toArray())->default(FeeBy::MERCHANT);
            $table->unsignedInteger('fee_max')->default(40000)->comment('Rial');

            $table->string('name', 64)->comment('Merchant`s name to show on gateway page');
            $table->string('logo')->nullable();
            $table->string('domain', 255)->comment('Merchant`s main domain');

            $table->boolean('multiplex_support')->default(false);
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
