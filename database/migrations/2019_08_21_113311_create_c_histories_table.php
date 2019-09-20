<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan_id')->unsigned()->nullable();
            $table->foreign(['plan_id'])->references('id')->on('contents')->onDelete('cascade');
            $table->integer('c_status_id')->unsigned()->nullable();
            $table->foreign(['c_status_id'])->references('id')->on('c_statuses')->onDelete('cascade');
            $table->integer('platform_used_id')->nullable();
            $table->integer('type_module')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('c_histories');
    }
}
