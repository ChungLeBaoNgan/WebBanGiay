<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThuonghieu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thuonghieu', function (Blueprint $table) {
            $table->Increments('th_ma'); //Increments là khóa chính
            $table->String('th_ten');
            $table->timestamps(); //tự động thêm thời gian tạo
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thuonghieu');
    }
}
