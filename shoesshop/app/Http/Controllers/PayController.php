<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class PayController extends Controller
{
    public function authLogin(){
        $admin_id = Session::get('nd_ma');
        if ($admin_id) 
            return Redirect::to('/dashboard'); 
        else 
            return Redirect::to('/admin')->send();
    }

    public function manage_pay(){
    	 $this->authLogin();
    	$list_pay = DB::table('thanhtoan')->get();
    	$manager_pay = view('admin.manage_pay')->with('list_pay', $list_pay);
    	return view('admin_layout')->with('admin.manage_pay', $manager_pay);
    }
    public function add_pay(){
    	 $this->authLogin();
    	 return view('admin.add_pay');
    }
    public function save_pay(Request $request){
    	$this->authLogin();
    	$data = array();
        $data['tt_ten'] = $request->pay_name;
        Db::table('thanhtoan')->insert($data);
        Session::put('message','The pay method was added successfully.');
        return Redirect::to('/manage-pay');
    }
    public function edit_pay($edit_id){
        $this->authLogin();     
        $list_pay = DB::table("thanhtoan")->where('tt_ma', $edit_id)->orderby('tt_ma','desc')->get();
        
        // echo $hinh_anh;
        return view('admin.edit_pay')->with('list_pay', $list_pay);
    }
    public function update_pay(Request $request, $update_id){
    	$this->authLogin();  
        $data= array();
        $data['tt_ten']=$request->pay_name;
        DB::table('thanhtoan')->where('tt_ma', $update_id)->update($data);
        Session::put('message','The product was updated successfully.');
        return Redirect::to('/manage-pay');
    }
    public function delete_pay($delete_id){
    	$this->authLogin();  
    	DB::table('thanhtoan')->where('tt_ma', $delete_id)->delete();
    	Session::put('message','The product was deleted successfully.');
        return Redirect::to('/manage-pay');
    }
}
