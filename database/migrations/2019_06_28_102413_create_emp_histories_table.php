<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('remarks')->nullable();
            $table->integer('job_id')->unsigned()->nullable();
            $table->foreign(['job_id'])->references('id')->on('job_applications')->onDelete('cascade');
            $table->integer('call_id')->unsigned()->nullable();
            $table->foreign(['call_id'])->references('id')->on('call_statuses')->onDelete('cascade');
            $table->dateTime('dateTime');
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
        Schema::dropIfExists('emp_histories');
    }
}
