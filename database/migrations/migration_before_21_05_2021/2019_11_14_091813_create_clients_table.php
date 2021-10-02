<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('company_name');
            $table->string('name');
            $table->string('job_title');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('city');
            $table->string('state');
            $table->string('web_url')->nullable();
            $table->string('package')->nullable();
            $table->string('job_opening')->nullable();
            $table->string('industry')->nullable();
            $table->string('service')->nullable();
            $table->string('note')->nullable();
            $table->integer('recruitment_pipeline')->nullable()->default(0);
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
        Schema::dropIfExists('clients');
    }
}
