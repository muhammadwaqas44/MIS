<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',"150")->nullable();
            $table->string('contact_no_primary')->nullable();
            $table->string('contact_no_secondary')->nullable();
            $table->string('landline')->nullable();
            $table->string('address','500')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('professional_id')->nullable();
            $table->string('attech_file')->nullable();
            $table->string('remarks','1050')->nullable();
            $table->integer('is_active')->default(true);
            $table->integer('created_by')->unsigned()->nullable();
            $table->foreign(['created_by'])->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('vendors');
    }
}
