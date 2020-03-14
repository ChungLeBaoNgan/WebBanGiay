<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class OrderController extends Controller
{
	 public function authLogin(){
        $admin_id = Session::get('nd_ma');
        if ($admin_id) 
            return Redirect::to('/dashboard'); 
        else 
            return Redirect::to('/admin')->send();
    }

    public function showOrder()
    {
    	$this->authLogin();
        $orders = DB::table('donhang')->join('nguoidung','nguoidung.nd_ma','donhang.nd_ma')->join('thanhtoan','thanhtoan.tt_ma','donhang.tt_ma')->join('vanchuyen','vanchuyen.vc_ma','donhang.vc_ma')->orderby('donhang.dh_ma','desc')->get();
    	return view('admin.manage_order')->with('orders',$orders);
    }

    public function viewOrder($dh_ma)
    {
    	$this->authLogin();
        $order = DB::table('donhang')->join('nguoidung','nguoidung.nd_ma','donhang.nd_ma')->join('thanhtoan','thanhtoan.tt_ma','donhang.tt_ma')->join('vanchuyen','vanchuyen.vc_ma','donhang.vc_ma')->where('donhang.dh_ma','=',$dh_ma)->first();
        $items = DB::table('chitietdonhang')->join('chitietsanpham','chitietsanpham.ctsp_ma','chitietdonhang.ctsp_ma')->join('sanpham','sanpham.sp_ma','chitietsanpham.sp_ma')->where('dh_ma',$dh_ma)->get();
        return view('admin.view_order')->with('order',$order)->with('items',$items); 	
    }

    public function approveOrder($dh_ma)
    {
        $this->authLogin();
        try {
    
            $count = DB::table('donhang')->where('dh_ma', $dh_ma)->update(['dh_trangThai' => 'Đã xử lý']);
            Session::put('success_message','Cập nhật trạng thái đơn hàng thành công!');
            
        } catch (\Illuminate\Database\QueryException $e) {
            Session::put('fail_message','Cập nhật trạng thái đơn hàng không thành công!');
        }
      
    }

    public function shipOrder($dh_ma)
    {
        $this->authLogin();
        try {
    
            $count = DB::table('donhang')->where('dh_ma', $dh_ma)->update(['dh_trangThai' => 'Đang giao']);
            Session::put('success_message','Cập nhật trạng thái đơn hàng thành công!');
            
        } catch (\Illuminate\Database\QueryException $e) {
            Session::put('fail_message','Cập nhật trạng thái đơn hàng không thành công!');
        }
        

    }

    public function completeOrder($dh_ma)
    {
        $this->authLogin();
        try {
    
            $count = DB::table('donhang')->where('dh_ma', $dh_ma)->update(['dh_trangThai' => 'Đã giao']);
            Session::put('success_message','Cập nhật trạng thái đơn hàng thành công!');
            
        } catch (\Illuminate\Database\QueryException $e) {
            Session::put('fail_message','Cập nhật trạng thái đơn hàng không thành công!');
        }
       
    }

    public function cancelOrder($dh_ma)
    {
        $this->authLogin();
        try {
    
            $count = DB::table('donhang')->where('dh_ma', $dh_ma)->update(['dh_trangThai' => 'Đã hủy']);
            Session::put('success_message','Cập nhật trạng thái đơn hàng thành công!');
            $items_cancel = DB::table('chitietdonhang')->join('chitietsanpham','chitietdonhang.ctsp_ma','chitietsanpham.ctsp_ma')->where('dh_ma', $dh_ma)->select('chitietdonhang.ctsp_ma','chitietdonhang.soLuongDat','chitietsanpham.ctsp_soLuongTon')->get();
            foreach ($items_cancel as $key => $item) {
                try{
                    /*echo $item->soLuongDat;
                    echo $item->ctsp_soLuongTon;*/
                   /*echo*/  $new_stock = $item->soLuongDat+$item->ctsp_soLuongTon;

                    DB::table('chitietsanpham')->where('ctsp_ma', $item->ctsp_ma)->update(['ctsp_soLuongTon' => $new_stock]);
                }catch (\Illuminate\Database\QueryException $e) {
                    Session::put('fail_message','Cập nhật trạng thái đơn hàng không thành công!');
                }
            }

            
        } catch (\Illuminate\Database\QueryException $e) {
            Session::put('fail_message','Cập nhật trạng thái đơn hàng không thành công!');
        }
        
       
    }
}
