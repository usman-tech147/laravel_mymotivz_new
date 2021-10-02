<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_interviews', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('candidate_id')->nullable() ;
            $table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('cascade');
            $table->unsignedBigInteger('status_id')->nullable() ;
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');

            $table->unsignedBigInteger('job_id')->nullable() ;
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->unsignedBigInteger('client_id')->nullable() ;
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->string('time_zone');
            $table->string('location');
            $table->string('subject');
            $table->text('message');
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
        Schema::dropIfExists('schedule_interviews');
    }
}
