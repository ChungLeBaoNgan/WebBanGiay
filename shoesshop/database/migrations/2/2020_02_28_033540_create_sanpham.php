<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSanpham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->Increments('sp_ma'); //Increments là khóa chính
            $table->String('sp_ten');
            $table->Integer('sp_donGiaBan')->unsigned()->nullable();
            $table->Integer('sp_donGiaNhap')->unsigned()->nullable();
            $table->Text('sp_ghiChu');
            $table->Integer('th_ma')->unsigned();
            $table->foreign('th_ma')->references('th_ma')->on('thuonghieu');
            $table->Integer('dm_ma')->unsigned();
            $table->foreign('dm_ma')->references('dm_ma')->on('danhmuc');
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
        Schema::dropIfExists('sanpham');
    }
}
