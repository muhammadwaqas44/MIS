<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWinnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('winners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cnic')->nullable();
            $table->string('account')->nullable();
            $table->string('prize')->nullable();
            $table->string('social_link')->nullable();
            $table->string('status')->nullable();
            $table->string('question')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign(['user_id'])->references('id')->on('users')->onDelete('cascade');
            $table->integer('role_id')->unsigned()->default(3);
            $table->foreign(['role_id'])->references('id')->on('roles')->onDelete('cascade');
            $table->integer('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('winners');
    }
}
