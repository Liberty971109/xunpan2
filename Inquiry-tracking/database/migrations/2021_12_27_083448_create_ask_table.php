<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ask', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('site_id');
            $table->string('message_name');     //询盘标题
            $table->text('message');            //询盘内容
            $table->string('sent_from');        //询盘发送者
            $table->string('sent_to');          //询盘接收者
            $table->string('location');         //(国家+地区)
            $table->string('source');           //询盘获得渠道
            $table->integer('rating');          //询盘质量打分
            $table->text('note');               //询盘备注
            $table->json('message_info');       //更多信息
            $table->dateTime('date_time');      //询盘发送时间
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
        Schema::dropIfExists('ask');
    }
}
