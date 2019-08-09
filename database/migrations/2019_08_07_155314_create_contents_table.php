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
        return;
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name','500');
            $table->integer('youtube')->default(0);
            $table->integer('facebook')->default(0);
            $table->integer('instagram')->default(0);
            $table->integer('twitter')->default(0);
            $table->integer('linkedIn')->default(0);
            $table->integer('pinterest')->default(0);
            $table->integer('google_business')->default(0);
            $table->integer('dankash')->default(0);
            $table->integer('blog')->default(0);
            $table->integer('type_id')->nullable();
            $table->string('remarks', '1050')->nullable();
            $table->string('rawlength')->nullable();
            $table->string('finallength')->nullable();
            $table->string('timeline')->nullable();
            $table->string('priority')->nullable();
            $table->string('timelinebystaff')->nullable();
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
        Schema::dropIfExists('contents');
    }
}
