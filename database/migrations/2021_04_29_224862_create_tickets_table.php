<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->id();
            $table->string('cust_name');
            $table->text('problem_desc');
            $table->string('email');
            $table->string('phone_no')->nullable()->default(null);
            $table->string('reference_no');
            $table->string('status');
            $table->date('actioned_date')->nullable()->default(null);
            $table->unsignedBigInteger('actioned_user')->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket');
    }
}
