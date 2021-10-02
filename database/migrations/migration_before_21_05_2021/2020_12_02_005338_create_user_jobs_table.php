<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('job_title');
            $table->string('package')->nullable();
            $table->string('education')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('web_url')->nullable();
            $table->string('industry')->nullable();
            $table->string('job_description')->nullable();
            $table->string('job_responsibilities')->nullable();
            $table->string('job_benefits')->nullable();
            $table->string('required_skills')->nullable();
            $table->date('applied_before')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
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
        Schema::dropIfExists('user_jobs');
    }
}
