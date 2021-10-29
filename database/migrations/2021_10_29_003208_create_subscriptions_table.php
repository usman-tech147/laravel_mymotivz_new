<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('new_client_id');
            $table->unsignedBigInteger('plan_id');
            $table->string('status');
            $table->string('payment_id');
            $table->timestamp('start_date');
            $table->timestamp('end_date');

            $table->foreign('new_client_id')
                ->references('id')
                ->on('new_clients');

            $table->foreign('plan_id')
                ->references('id')
                ->on('plans');

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
        Schema::dropIfExists('subscriptions');
    }
}
