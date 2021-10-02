<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            $table->date('hiring_date')->nullable('true')->after('is_admin');
            $table->string('job_title')->nullable('true')->after('hiring_date');
            $table->string('home_address')->nullable('true')->after('job_title');
            $table->string('resume')->nullable('true')->after('home_address');
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
