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
            $table->string('animal_img',255)->default('')->comment('宠物头像');
            $table->string('animal_name',50)->default('')->comment('宠物名称');
            $table->string('animal_sex',255)->default('')->comment('宠物性别');
            $table->string('animal_year',255)->default('')->comment('宠物生日');
            $table->text('animal_qianming')->comment('宠物签名');
            $table->text('animal_shuoming')->comment('宠物说明');
            $table->string('uid',10)->default()->comment('宠主id');
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
