<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('topic',"500");
            $table->string('source',"500")->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign(['category_id'])->references('id')->on('content_types')->onDelete('cascade');
            $table->dateTime('produce_on')->nullable();
            $table->integer('produce_by')->nullable();
            $table->dateTime('process_on')->nullable();
            $table->integer('process_by')->nullable();
            $table->dateTime('publish_on')->nullable();
            $table->integer('publish_by')->nullable();
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
        Schema::dropIfExists('contents');
    }
}
