<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('name' , 100);
            $table->char('job_title' , 100);
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('city' , 100);
            $table->string('state' , 100);
            $table->string('salary');
            $table->string('skills');
            $table->string('interest');
            $table->integer('experience');
            $table->string('color')->nullable();
            $table->string('Industry');
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
        Schema::dropIfExists('candidates');
    }
}
