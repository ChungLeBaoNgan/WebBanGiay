<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonhang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donhang', function (Blueprint $table) {
            $table->Increments('dh_ma');
            $table->String('dh_tenNhan');
            $table->Text('dh_diaChiNhan');
            $table->String('dh_dienThoai');
            $table->String('dh_email');
            $table->Text('dh_ghiChu');
            $table->Date('dh_ngayDat');
            $table->String('dh_trangThai');
            $table->Integer('dh_tongTien')->unsigned();
            $table->Integer('vc_ma')->unsigned();
            $table->foreign('vc_ma')->references('vc_ma')->on('vanchuyen');
            $table->Integer('tt_ma')->unsigned();
            $table->foreign('tt_ma')->references('tt_ma')->on('thanhtoan');
            $table->Integer('nd_ma')->unsigned();
            $table->foreign('nd_ma')->references('nd_ma')->on('nguoidung');
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
        Schema::dropIfExists('donhang');
    }
}
