<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToEmpHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        return;
        Schema::table('emp_histories', function (Blueprint $table) {
            $table->string('remarks', '1050')->change();
            $table->integer('user_id')->unsigned()->nullable()->after('job_id');
            $table->foreign(['user_id'])->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emp_histories', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
