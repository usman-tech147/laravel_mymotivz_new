<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('new_client_id');
            $table->unsignedBigInteger('package_id');
            $table->timestamp('subscribed_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->string('subscribed_status')->nullable();
            $table->boolean('renewal_status')->nullable();
            $table->string('subscription_id')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_by')->nullable();
            $table->string('billing_agreement_id')->nullable();
            $table->string('error_message')->nullable();
            $table->string('frequency')->nullable();
            $table->string('interval_count')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('new_client_id')->references('id')
                ->on('new_clients')->onDelete('restrict');
            $table->foreign('package_id')->references('id')
                ->on('packages')->onDelete('restrict');
            $table->unique(['new_client_id','package_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_packages');
    }
}
