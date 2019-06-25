<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('recipient_no');
            $table->string('body','1050');
            $table->string('reference');
            $table->dateTime('sent_on');
            $table->integer('sent_by')->unsigned()->nullable();
            $table->foreign(['sent_by'])->references('id')->on('users')->onDelete('cascade');
            $table->string('status','500');
            $table->string('masking');
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
        Schema::dropIfExists('sms_logs');
    }
}
