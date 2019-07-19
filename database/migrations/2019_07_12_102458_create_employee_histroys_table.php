<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeHistroysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_histroys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email','50');
            $table->dateTime('date_of_birth');
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('father_name');
            $table->string('nationality')->nullable();
            $table->string('n_identity_type')->nullable();
            $table->string('n_identity_no')->nullable();
            $table->string('current_address');
            $table->string('current_city');
            $table->string('current_state');
            $table->string('current_country')->nullable();
            $table->string('permanent_address');
            $table->string('permanent_city');
            $table->string('permanent_state');
            $table->string('permanent_country')->nullable();
            $table->string('mobile_number');
            $table->string('secondary_number')->nullable();
            $table->string('skype_id')->nullable();
            $table->string('profile_image','500');
            $table->string('bank_name');
            $table->string('branch_name');
            $table->string('account_name');
            $table->string('account_no');
            $table->string('department_id');
            $table->string('designation_id');
            $table->string('location_id');
            $table->dateTime('joining_date');
            $table->string('resume','500')->nullable();
            $table->string('id_proof','500')->nullable();
            $table->string('other_doc_personal','500')->nullable();
            $table->string('official_latter','500')->nullable();
            $table->string('joining_latter','500')->nullable();
            $table->string('contract_paper','500')->nullable();
            $table->string('other_doc_official','500')->nullable();
            $table->integer('is_active')->default(true);
            $table->integer('job_id')->unsigned()->nullable();
            $table->foreign(['job_id'])->references('id')->on('job_applications')->onDelete('cascade');
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
        Schema::dropIfExists('employee_histroys');
    }
}
