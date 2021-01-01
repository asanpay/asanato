<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use App\Containers\IdentityProof\Enum\IdProofStatus;

class CreateIdentityproofTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(
            'identity_proofs', function (Blueprint $table) {

                $table->increments('id');
                $table->integer('user_id')->unsigned();
                $table->unsignedSmallInteger('proof_type');
                $table->string('value', 64)->index();
                $table->string('code', 128)->nullable();
                $table->datetime('verified_at')->nullable();
                $table->enum('status', IdProofStatus::toArray());
                $table->string('reject_reason')->nullable();
                $table->timestamps();
                $table->softDeletes();


                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('identity_proofs');
    }
}
