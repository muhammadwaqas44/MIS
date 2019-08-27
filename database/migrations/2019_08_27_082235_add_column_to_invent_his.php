<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToInventHis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invent_his', function (Blueprint $table) {
            $table->integer('status_id')->unsigned()->nullable()->after('inventory_id');
            $table->foreign(['status_id'])->references('id')->on('inventory_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invent_his', function (Blueprint $table) {
            $table->dropColumn('status_id');
        });
    }
}
