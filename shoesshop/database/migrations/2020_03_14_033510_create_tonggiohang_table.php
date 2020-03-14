<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTonggiohangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tonggiohang', function (Blueprint $table) {
            $table->increments('tgh_ma');
            $table->integer('tgh_tong');
            $table->integer('km_giamGia');
            $table->integer('nd_ma');
            $table->integer('tgh_gtong');
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
        Schema::dropIfExists('tonggiohang');
    }
}
