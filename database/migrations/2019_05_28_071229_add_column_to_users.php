<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('city_id')->unsigned()->nullable();
            $table->foreign(['city_id'])->references('id')->on('cities')->onDelete('cascade');
            $table->string('state_id')->unsigned()->nullable();
            $table->foreign(['state_id'])->references('id')->on('states')->onDelete('cascade');
            $table->string('country_id')->unsigned()->nullable();
            $table->foreign(['country_id'])->references('id')->on('countries')->onDelete('cascade');
            $table->integer('role_id')->unsigned()->nullable();
            $table->foreign(['role_id'])->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('city_id');
            $table->dropColumn('state_id');
            $table->dropColumn('country_id');
            $table->dropColumn('role_id');
        });
    }
}
