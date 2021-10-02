<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id')->nullable() ;
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->string('business_name');
            $table->string('business_address');
            $table->string('business_number');
            $table->string('business_web');
            $table->string('full_name');
            $table->string('job_title');
            $table->string('phone_no');
            $table->string('email');
            $table->string('positions');
            $table->string('openings');
            $table->string('quoted_fee');
            $table->string('industry_types');
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
        Schema::dropIfExists('contracts');
    }
}
