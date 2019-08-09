<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->integer('user_int')->default(0)->after('name');
            $table->integer('hiring_int')->default(0)->after('user_int');
            $table->integer('emp_int')->default(0)->after('hiring_int');
            $table->integer('sms_int')->default(0)->after('emp_int');
            $table->integer('vendor_int')->default(0)->after('sms_int');
            $table->integer('content_int')->default(0)->after('vendor_int');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
           $table->dropColumn('user_int');
           $table->dropColumn('hiring_int');
           $table->dropColumn('emp_int');
           $table->dropColumn('sms_int');
           $table->dropColumn('vendor_int');
           $table->dropColumn('content_int');
        });
    }
}
