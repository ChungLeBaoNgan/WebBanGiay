<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNguoidung extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nguoidung', function (Blueprint $table) {
            $table->Increments('nd_ma'); //Increments là khóa chính
            $table->String('nd_ten',50);
            $table->String('nd_email',50);
            $table->String('nd_dienThoai',10);
            $table->String('nd_matKhau',50);
            $table->Boolean('nd_gioiTinh');
            $table->Date('nd_ngaySinh');
            $table->Text('nd_diaChi');
            $table->Integer('cv_ma')->unsigned();
            $table->foreign('cv_ma')->references('cv_ma')->on('chucvu');
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
        Schema::dropIfExists('nguoidung');
    }
}
