<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
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
            $table->integer('is_active')->default(true);
            $table->integer('job_id')->unsigned()->nullable();
            $table->foreign(['job_id'])->references('id')->on('job_applications')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE employees AUTO_INCREMENT = 1100;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
