<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdvertisementController extends Controller
{
    public function authLogin(){
        $admin_id = Session::get('nd_ma');
        if ($admin_id) 
            return Redirect::to('/dashboard'); 
        else 
            return Redirect::to('/admin')->send();
    }

    public function addAdvertisement(){
    	$this->authLogin();
    	return view('admin.add_advertisement');
    }

    public function saveCoupon(Request $request){
    	$this->authLogin();
    	$data = array();
        $data['qc_ten'] = $request->ad_name;

        $get_image = '';
        if ($request->hasFile('ad_image')){
            $this->validate($request,
                                ['ad_image'=>'mimes:jpg,jpeg,png,gif|max:2048',
                                ],
                                ['ad_image.mimes'=>'Only accept jpg, jpeg, png, gif.',
                                 'ad_image.max'=>'Max file size: 5MB.',
                                ]
                            );

            $product_image = $request->file('ad_image');
            if ($product_image){
                $get_image = $product_image->getClientOriginalName();
                $destinationPath = public_path('upload/product');
                $product_image->move($destinationPath, $get_image);
                $data_img = array();
                
                $data_img['qc_ma'] = DB::table('quangcao')->insertGetId($data);               
                $data_img['ha_ten']=$get_image;
                DB::table('hinhanh')->insert($data_img);
                Session::put('message','The product was added successfully.');
                return Redirect::to('/manage-product');
            }
            
            
        }
        $data['pro_image']=$get_image;
        DB::table('sanpham')->insert($data);
        Session::put('message','The product was added successfully.');
        return Redirect::to('/manage-product');
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
