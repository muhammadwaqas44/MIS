<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description', "1500")->nullable();
            $table->dateTime('date');
            $table->string('amount');
            $table->integer('exp_type_id')->unsigned()->nullable();
            $table->foreign(['exp_type_id'])->references('id')->on('exp_types')->onDelete('cascade');
            $table->integer('expCategory_id')->unsigned()->nullable();
            $table->foreign(['expCategory_id'])->references('id')->on('exp_categories')->onDelete('cascade');
            $table->string('image', '500')->nullable();
            $table->integer('employee_id')->unsigned()->nullable();
            $table->foreign(['employee_id'])->references('id')->on('users')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign(['user_id'])->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('expenses');
    }
}
