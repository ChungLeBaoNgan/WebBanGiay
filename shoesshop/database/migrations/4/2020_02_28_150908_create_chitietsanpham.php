<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChitietsanpham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietsanpham', function (Blueprint $table) {
            $table->Increments('ctsp_ma');
            $table->Integer('ctsp_kichCo'); 
            $table->Integer('ctsp_soLuongNhap')->unsigned(); 
            $table->Integer('ctsp_soLuongTon')->unsigned();
            $table->Integer('sp_ma')->unsigned(); 
            $table->Integer('pn_ma')->unsigned();
            $table->foreign('sp_ma')->references('sp_ma')->on('sanpham');
            $table->foreign('pn_ma')->references('pn_ma')->on('phieunhap');
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
        Schema::dropIfExists('chitietsanpham');
    }
}
