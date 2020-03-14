<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chitietsanpham extends Model
{
    protected $table = 'chitietsanpham';
    public $primaryKey = 'ctsp_ma';
    protected $fillable = ['ctsp_ma','sp_ma','ctsp_kichCo','ctsp_soLuongTon'];
    public $timestamps = false;

}
