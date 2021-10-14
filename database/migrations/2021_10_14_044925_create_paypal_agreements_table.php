<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaypalAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypal_agreements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('new_client_id');
            $table->unsignedBigInteger('package_id');
            $table->string('agreement_id')->unique();
            $table->foreign('new_client_id')->references('id')->on('new_clients')->onDelete('restrict');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('restrict');
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
        Schema::dropIfExists('paypal_agreements');
    }
}
