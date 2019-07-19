<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToCallStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('call_statuses', function (Blueprint $table) {
            $table->integer('join_emp')->default(0)  ->comment = 'Join Employee';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('call_statuses', function (Blueprint $table) {
            $table->dropColumn('join_emp');
        });
    }
}
