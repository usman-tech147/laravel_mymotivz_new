<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdJob extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
//        Schema::table('jobs', function (Blueprint $table) {
//            $table-> $table->dropColumn('user_id');
//
//        });
        Schema::table('jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('pipeline_id')->nullable()->after('id');
            $table->foreign('pipeline_id')->references('id')->on('users')->onDelete('cascade');
        });
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
