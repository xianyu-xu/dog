<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeThingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_things', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',50)->comment('事件标题');
            $table->string('content',255)->comment('时间内容');
            $table->string('time',100)->comment('事件时间');
            $table->string('uid',100)->comment('事件用户');
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
        Schema::dropIfExists('time_things');
    }
}
