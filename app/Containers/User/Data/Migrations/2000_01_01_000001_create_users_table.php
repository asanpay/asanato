<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use App\Containers\User\Enum\UserType;
use App\Containers\User\Enum\UserGender;
use App\Containers\User\Enum\UserGroup;

class CreateUsersTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->enum('type', UserType::toArray())->default(UserType::UNKNOWN);
            //personal
            $table->string('first_name', 30)->nullable();
            $table->string('last_name', 30)->nullable();
            $table->string('national_id', 10)->nullable();
            $table->enum('gender', UserGender::toArray())->default(UserGender::UNKNOWN);
            $table->date('birth_date')->nullable();


            // company
            $table->string('company', 50)->nullable();
            $table->string('financial_id', 14)->nullable();


            $table->unsignedBigInteger('mobile')->unique();
            $table->string('email', 48)->nullable();

            $table->enum('group', UserGroup::toArray())->default(UserGroup::NORMAL);

            $table->string('avatar_social', 255)->nullable();
            $table->string('register_via', 30)->default('WEB');
            $table->string('register_ip',15);
            $table->string('referrer',40)->nullable();


            $table->text('notes')->nullable();

            // residency
            $table->unsignedInteger('location_id')->index()->nullable();

            $table->string('tel', 16)->nullable();
            $table->string('address', 196)->nullable();
            $table->string('zip', 10)->nullable();

            $table->jsonb('meta')->default('{}');

            $table->string('password', 64);
            $table->boolean('locked')->default(false);
            $table->string('locked_reason')->nullable();

            // see UserVerifications class
            $table->unsignedSmallInteger('verification')->default(0)->comment('bit value');

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('location_id')
                ->references('id')
                ->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropForeign(['location_id']);
        });


        Schema::dropIfExists('users');
    }
}
