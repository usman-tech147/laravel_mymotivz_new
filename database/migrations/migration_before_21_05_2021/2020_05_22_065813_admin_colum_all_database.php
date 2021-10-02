<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminColumAllDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
//        Schema::table('clients', function (Blueprint $table) {
//            $table->unsignedBigInteger('user_id')->nullable()->after('id') ;
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//        });

        Schema::table('schedule_interviews', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->default(1)->after('id') ;
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
//        Schema::table('contracts', function (Blueprint $table) {
//            $table->unsignedBigInteger('user_id')->nullable()->after('id') ;
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
