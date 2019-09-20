<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_media', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan_id')->unsigned()->nullable();
            $table->foreign(['plan_id'])->references('id')->on('contents')->onDelete('cascade');
            $table->integer('platform_id')->default(1);
            $table->string('media', '500')->nullable();
            $table->integer('is_active')->default(true);
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
        Schema::dropIfExists('c_media');
    }
}
