<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('new_client_id');
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->string('payment_id')->nullable();
            $table->integer('subtotal')->nullable();
            $table->integer('tax')->default('0');
            $table->integer('total_amount')->nullable();
            $table->string('payment_by')->nullable();
            $table->timestamps();
            $table->foreign('plan_id')
                ->references('id')
                ->on('plans')
                ->onDelete('restrict');
            $table->foreign('new_client_id')
                ->references('id')
                ->on('new_clients')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
