<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account')->comment('账号');
            $table->string('password')->comment('密码');
            $table->string('country_code')->nullable()->comment('国家编码');
            $table->string('country_name')->nullable()->comment('国家名');
            $table->string('city_code')->nullable()->comment('城市编码');
            $table->string('city_name')->nullable()->comment('城市名');
            $table->string('center_code')->nullable()->comment('考场编码');
            $table->string('test_time')->nullable()->comment('考试时间');
            // $table->string('card_num')->nullable()->comment('支付卡号');
            // $table->string('card_type')->nullable()->comment('卡类型');
            // $table->string('card_security')->nullable()->comment('卡安全码');
            // $table->string('card_expire_month')->nullable()->comment('卡过期月份');
            // $table->string('card_expire_year')->nullable()->comment('卡过期年份');
            $table->integer('status')->default(0)->comment('报名状态');
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
        Schema::dropIfExists('orders');
    }
}
