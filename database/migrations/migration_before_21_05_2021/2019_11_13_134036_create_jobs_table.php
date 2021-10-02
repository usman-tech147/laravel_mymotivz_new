<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jobtitle');
            $table->string('city');
            $table->string('state');
            $table->string('web_url')->nullable();
            $table->string('package')->nullable();
            
            $table->string('industry')->nullable();
            $table->string('service')->nullable();
            
            $table->integer('recruitment_pipeline')->default(1);
            $table->string('job_discription')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
