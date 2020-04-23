<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card', function (Blueprint $table) {
            $table->increments('id');
            $table->string('card_num')->comment('卡号');
            $table->string('card_type')->comment('卡类型');
            $table->string('card_security')->comment('卡安全码');
            $table->string('card_expire_month')->comment('卡有效期月份');
            $table->string('card_expire_year')->comment('卡有效期年份');
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
        Schema::dropIfExists('card');
    }
}
