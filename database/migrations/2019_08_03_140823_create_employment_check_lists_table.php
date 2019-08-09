<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploymentCheckListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment_check_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emp_form')->default(0);
            $table->dateTime('form_date')->nullable();
            $table->string('form_remarks','1050')->nullable();
            $table->integer('emp_cnic')->default(0);
            $table->dateTime('cnic_date')->nullable();
            $table->string('cnic_remarks', '1050')->nullable();
            $table->integer('emp_photos')->default(0);
            $table->dateTime('photo_date')->nullable();
            $table->string('photo_remarks', '1050')->nullable();
            $table->integer('emp_educational_original')->default(0);
            $table->dateTime('educational_original_date')->nullable();
            $table->string('educational_original_remarks', '1050')->nullable();
            $table->integer('emp_educational_copy')->default(0);
            $table->dateTime('educational_copy_date')->nullable();
            $table->string('educational_copy_remarks', '1050')->nullable();
            $table->integer('emp_original_deg')->default(0);
            $table->dateTime('original_deg_date')->nullable();
            $table->string('original_deg_remarks', '1050')->nullable();
            $table->integer('emp_nda')->default(0);
            $table->dateTime('nda_date')->nullable();
            $table->string('nda_remarks', '1050')->nullable();
            $table->integer('emp_agreement')->default(0);
            $table->dateTime('agreement_date')->nullable();
            $table->string('agreement_remarks', '1050')->nullable();
            $table->integer('emp_biometric')->default(0);
            $table->dateTime('biometric_date')->nullable();
            $table->string('biometric_remarks', '1050')->nullable();
            $table->integer('emp_office_policies')->default(0);
            $table->dateTime('office_policies_date')->nullable();
            $table->string('office_policies_remarks', '1050')->nullable();
            $table->integer('employee_id')->unsigned()->nullable();
            $table->foreign(['employee_id'])->references('id')->on('employees')->onDelete('cascade');
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
        Schema::dropIfExists('employment_check_lists');
    }
}
