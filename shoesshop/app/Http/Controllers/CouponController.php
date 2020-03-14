<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CouponController extends Controller
{
     public function authLogin(){
        $admin_id = Session::get('nd_ma');
        if ($admin_id) 
            return Redirect::to('/dashboard'); 
        else 
            return Redirect::to('/admin')->send();
    }

    public function addCoupon(){
    	$this->authLogin();
    	return view('admin.add_coupon');
    }

    public function saveCoupon(Request $request){
    	$this->authLogin();
    	$data = array();
        $data['km_doanMa'] = $request->coupon_code;
        $data['km_chuDe'] = $request->coupon_topic;
        $data['km_giamGia'] = $request->coupon_discount;
        Db::table('khuyenmai')->insert($data);
        Session::put('message','Thêm thành công');
        return Redirect::to('/manage-coupon');
    }

    public function showCoupon(){
        $this->authLogin();
    	$list_coupon = DB::table('khuyenmai')->get();
    	$manager_coupon = view('admin.manage_coupon')->with('list_coupon', $list_coupon);
    	return view('admin_layout')->with('admin.manage_coupon', $manager_coupon);
    	/*return view('admin.manage_category');*/
    }
    
    public function editCoupon($Coupon_id){
         $this->authLogin();
        $edit_coupon = DB::table('khuyenmai')->where('km_ma',$Coupon_id)->get(); //Lấy 1 sản phẩm
        $manager_coupon = view('admin.edit_coupon')->with('edit_coupon',$edit_coupon);
        return view('admin_layout')->with('admin.edit_coupon', $manager_coupon);
        /*return view('admin.manage_category');*/
    }

    public function updateCoupon(Request $request,$Coupon_id){
        $data = array();
        $data['km_doanMa'] = $request->coupon_code;
        $data['km_chuDe'] = $request->coupon_topic;
        $data['km_giamGia'] = $request->coupon_discount;
        DB::table('khuyenmai')->where('km_ma',$Coupon_id)->update($data);
        Session::put('message','Cập nhật thành công');
        return Redirect::to('/manage-coupon');
    }
    public function deleteCoupon($Coupon_id){
        DB::table('khuyenmai')->where('km_ma',$Coupon_id)->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('/manage-coupon');
    }
}
