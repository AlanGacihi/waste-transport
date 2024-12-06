<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResdemsTable extends Migration
{
    public function up()
    {
        Schema::create('resdems', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('demand');
            $table->unsignedInteger('servid');
            $table->integer('quantity');
            $table->foreign('servid')->references('id')->on('services')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('resdems');
    }
}
