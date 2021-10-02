<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsNewColumnToAddJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('applied__jobs', function (Blueprint $table) {
            $table->intger('isNew')->default(1) ;
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
        Schema::table('applied__jobs', function (Blueprint $table)
        {
            $table->dropColumn('isNew');
        });    }
}
