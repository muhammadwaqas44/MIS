<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChangeColumnToEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('email','50')->unique()->change();
            $table->dateTime('date_of_birth')->nullable()->change();
            $table->string('father_name')->nullable()->change();
            $table->string('current_address')->nullable()->change();
            $table->string('current_city')->nullable()->change();
            $table->string('current_state')->nullable()->change();
            $table->string('permanent_address')->nullable()->change();
            $table->string('permanent_city')->nullable()->change();
            $table->string('permanent_state')->nullable()->change();
            $table->string('profile_image','500')->nullable()->change();
            $table->string('bank_name')->nullable()->change();
            $table->string('branch_name')->nullable()->change();
            $table->string('account_name')->nullable()->change();
            $table->string('account_no')->nullable()->change();
            $table->dateTime('joining_date')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('father_name');
            $table->dropColumn('current_address');
            $table->dropColumn('current_city');
            $table->dropColumn('current_state');
            $table->dropColumn('permanent_address');
            $table->dropColumn('permanent_city');
            $table->dropColumn('permanent_state');
            $table->dropColumn('profile_image');
            $table->dropColumn('bank_name');
            $table->dropColumn('branch_name');
            $table->dropColumn('account_name');
            $table->dropColumn('account_no');
            $table->dropColumn('joining_date');
        });
    }
}
