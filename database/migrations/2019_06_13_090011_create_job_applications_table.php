<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',"150");
            $table->string('email',50)->unique();
            $table->string('user_phone');
            $table->string('address')->nullable();
            $table->string('city_name')->nullable();
            $table->string('resume', '500')->nullable();
            $table->integer('channel_id')->unsigned()->nullable();
            $table->foreign(['channel_id'])->references('id')->on('channels')->onDelete('cascade');
            $table->integer('designation_id')->unsigned()->nullable();
            $table->foreign(['designation_id'])->references('id')->on('designations')->onDelete('cascade');
            $table->integer('experience_id')->unsigned()->nullable();
            $table->foreign(['experience_id'])->references('id')->on('experiences')->onDelete('cascade');
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
        Schema::dropIfExists('job_applications');
    }
}
