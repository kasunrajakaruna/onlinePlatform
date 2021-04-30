<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketReplysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_reply', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id');
            $table->text('reply');
            $table->string('email');
            $table->date('actioned_date');
            $table->unsignedBigInteger('actioned_user');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('ticket_id')
                ->references('id')
                ->on('tickets');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_reply');
    }
}
