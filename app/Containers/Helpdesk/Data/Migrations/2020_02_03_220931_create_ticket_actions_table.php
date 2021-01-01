<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Containers\Helpdesk\Enum\Platform;
use App\Containers\Helpdesk\Enum\TicketActionType;

class CreateTicketActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'ticket_actions', function (Blueprint $table) {
                $table->increments('id');

                $table->unsignedBigInteger('user_id')->index();
                $table->unsignedBigInteger('ticket_id')->index();

                $table->enum('type', TicketActionType::toArray());
                $table->text('content')->nullable();


                $table->string('ip');
                $table->boolean('private')->default(false);
                $table->boolean('seen')->default(false);
                $table->enum('platform', Platform::toArray());

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
                $table->foreign('ticket_id')
                    ->references('id')
                    ->on('tickets');
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

        Schema::table(
            'ticket_actions', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropForeign(['ticket_id']);
            }
        );


        Schema::drop('ticket_actions');
    }
}
