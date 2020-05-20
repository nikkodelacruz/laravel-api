<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('customer_id');
            $table->integer('doctor_id');
            $table->integer('schedule_id');
            $table->integer('procedure_id');
            $table->integer('branch_id');
            $table->text('time_slot');
            $table->date('date');

            // assign foreign key
            // $table->integer('customer_id')->unsigned();
            // $table->foreign('customer_id')->references('id')->on('customers')
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
