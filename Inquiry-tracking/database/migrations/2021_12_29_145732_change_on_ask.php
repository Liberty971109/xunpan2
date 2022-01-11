<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeOnAsk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asks', function (Blueprint $table) {
            //
            $table->integer('rating')->nullable()->change();          //询盘质量打分
            $table->text('note')->nullable()->change();               //询盘备注
            $table->json('message_info')->nullable()->change();       //更多信息
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asks', function (Blueprint $table) {
            //
        });
    }
}
