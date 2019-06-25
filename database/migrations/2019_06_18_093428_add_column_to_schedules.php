<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->integer('call_id')->unsigned()->nullable()->after('remarks');
            $table->foreign(['call_id'])->references('id')->on('call_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn('call_id');
        });
    }
}
