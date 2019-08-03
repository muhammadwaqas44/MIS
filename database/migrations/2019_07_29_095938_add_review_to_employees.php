<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReviewToEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
           $table->dateTime('probation_due_on')->nullable();
           $table->string('remarks',1050)->nullable();
           $table->integer('review_id')->unsigned()->nullable();
            $table->foreign(['review_id'])->references('id')->on('employee_reviews')->onDelete('cascade');
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
            $table->dropColumn('probation_due_on');
            $table->dropColumn('remarks');
            $table->dropColumn('review_id');
        });
    }
}
