<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('parent_id')->nullable();
            $table->string('module');
            $table->integer('is_active')->default(true);
            $table->integer('ini_int')->nullable()  ->comment = 'Initial Interview';
            $table->integer('short_int')->nullable()  ->comment = 'Short Listed';
            $table->integer('tech_int')->nullable()  ->comment = 'Technical Interview Required';
            $table->integer('hr_int')->nullable()  ->comment = 'HR Interview';

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
        Schema::dropIfExists('call_statuses');
    }
}
