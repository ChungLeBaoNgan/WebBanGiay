<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHinhanh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hinhanh', function (Blueprint $table) {
           $table->Increments('ha_ma'); //Increments là khóa chính
            $table->String('ha_ten');
            $table->Integer('sp_ma')->unsigned();
            $table->foreign('sp_ma')->references('sp_ma')->on('sanpham');
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
        Schema::dropIfExists('hinhanh');
    }
}
