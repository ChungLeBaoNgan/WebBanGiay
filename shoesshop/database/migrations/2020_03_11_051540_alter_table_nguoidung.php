<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableNguoidung extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nguoidung',function(Blueprint $table){
            $table->String('nd_matKhau_reset',50);
            $table->Integer('nd_trangThai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nguoidung',function(Blueprint $table){
            $table->dropColumn(['nd_trangThai','nd_matKhau_reset']);
        });
    }
}
