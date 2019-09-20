<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCYoutubesTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */

    public function up()
    {
        Schema::create('c_youtubes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('platform_id')->unsigned()->nullable();
            $table->foreign(['platform_id'])->references('id')->on('c_platforms')->onDelete('cascade');

            $table->integer('used_platform_id')->nullable();

            $table->integer('plan_id')->unsigned()->nullable();
            $table->foreign(['plan_id'])->references('id')->on('contents')->onDelete('cascade');

            $table->string('title', '500')->nullable();
            $table->string('tags', '1000')->nullable();
            $table->string('hash_tags', '1000')->nullable();
            $table->string('playlist', '1000')->nullable();

            $table->integer('view_access_id')->nullable();
            $table->integer('license_id')->nullable();
            $table->string('web_links', '1000')->nullable();
            $table->string('end_screen', '1000')->nullable();
            $table->string('description', "1500")->nullable();


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
        Schema::dropIfExists('c_youtubes');
    }
}
