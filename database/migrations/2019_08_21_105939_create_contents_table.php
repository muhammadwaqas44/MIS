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
            $table->string('tags',"1500")->nullable();
            $table->string('keywords',"1500")->nullable();
            $table->string('reference_material',"2000")->nullable();
            $table->string('source',"500")->nullable();
            $table->text('instructions')->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign(['category_id'])->references('id')->on('content_types')->onDelete('cascade');
            $table->dateTime('produce_on')->nullable()->default(null);
            $table->integer('produce_by')->nullable();
            $table->dateTime('process_on')->nullable()->default(null);
            $table->integer('process_by')->nullable();
            $table->dateTime('publish_on')->nullable()->default(null);
            $table->integer('publish_by')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->foreign(['created_by'])->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('contents');
    }
}
