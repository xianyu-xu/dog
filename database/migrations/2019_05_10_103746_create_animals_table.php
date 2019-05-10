<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('animal_img',255)->default()->comment('宠物头像');
            $table->string('animal_name',255)->default()->comment('宠物头像');
            $table->string('animal_',255)->default()->comment('宠物头像');
            $table->string('animal_',255)->default()->comment('宠物头像');
            $table->text('animal_')->default()->comment('宠物头像');
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
        Schema::dropIfExists('animals');
    }
}
