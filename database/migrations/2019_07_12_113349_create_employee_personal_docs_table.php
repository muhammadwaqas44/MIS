<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeePersonalDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_personal_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('resume','500')->nullable();
            $table->string('id_proof','500')->nullable();
            $table->string('other_doc_personal','500')->nullable();
            $table->integer('is_active')->default(true);
            $table->integer('employee_id')->unsigned()->nullable();
            $table->foreign(['employee_id'])->references('id')->on('employees')->onDelete('cascade');
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
        Schema::dropIfExists('employee_personal_docs');
    }
}
