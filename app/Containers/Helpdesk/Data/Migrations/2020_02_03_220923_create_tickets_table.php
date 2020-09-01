<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Containers\Helpdesk\Enum\TicketStatus;
use App\Containers\Helpdesk\Enum\Platform;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->text('content')->nullable();

            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('merchant_id')->index()->nullable();
            $table->unsignedInteger('agent_id')->index()->nullable();
            $table->unsignedInteger('priority')->index()->nullable();
            $table->unsignedInteger('category_id')->index()->nullable();
            $table->unsignedInteger('department')->index()->nullable();
            $table->unsignedInteger('sla')->index()->nullable();

            $table->unsignedSmallInteger('status')->default(TicketStatus::NEW);
            $table->string('ip')->nullable();
            $table->enum('platform', Platform::toArray());

            $table->dateTime('closed_at')->nullable();
            $table->dateTime('closed_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('agent_id')
                ->references('id')
                ->on('users');
            $table->foreign('merchant_id')
                ->references('id')
                ->on('merchants');
            //@todo add order foreign key
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['agent_id']);
            $table->dropForeign(['merchant_id']);
        });

        Schema::dropIfExists('tickets');
    }
}
