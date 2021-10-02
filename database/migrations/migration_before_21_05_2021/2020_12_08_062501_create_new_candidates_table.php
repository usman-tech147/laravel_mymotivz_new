<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_candidates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('name');
            $table->char('job_title')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('salary')->nullable();
            $table->string('skills')->nullable();
            $table->string('interest')->nullable();
            $table->string('experience')->nullable();
            $table->string('color')->nullable();
//            $table->string('industry')->nullable();
            $table->string('prof_image')->nullable();
            $table->longText('prof_summary')->nullable();
            $table->string('password');
            $table->string('code')->nullable();
            $table->string('random_code');
            $table->string('job_type')->nullable();
            $table->unsignedBigInteger('education_id')->nullable();
            $table->foreign('education_id')->references('id')->on('education')->onDelete('cascade');
            $table->unsignedBigInteger('job_id')->nullable();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->timestamps();
            $table->integer('email_verify')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_candidates');
    }
}
