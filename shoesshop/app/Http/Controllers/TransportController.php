<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class TransportController extends Controller
{
	 public function authLogin(){
        $admin_id = Session::get('nd_ma');
        if ($admin_id) 
            return Redirect::to('/dashboard'); 
        else 
            return Redirect::to('/admin')->send();
    }

    public function manage_transport(){
    	 $this->authLogin();
    	$list_transport = DB::table('vanchuyen')->get();
    	$manager_transport = view('admin.manage_transport')->with('list_transport', $list_transport);
    	return view('admin_layout')->with('admin.manage_transport', $manager_transport);
    }
    public function add_transport(){
    	 $this->authLogin();
    	 return view('admin.add_transport');
    }
    public function save_transport(Request $request){
    	$this->authLogin();
    	$data = array();
        $data['vc_ten'] = $request->transport_name;
        $data['vc_phi'] = $request->transport_price;
        Db::table('vanchuyen')->insert($data);
        Session::put('message','The category was added successfully.');
        return Redirect::to('/manage-transport');
    }
    public function edit_transport($edit_id){
        $this->authLogin();     
        $list_transport = DB::table("vanchuyen")->where('vc_ma', $edit_id)->orderby('vc_ma','desc')->get();
        
        // echo $hinh_anh;
        return view('admin.edit_transport')->with('list_transport', $list_transport);
    }
    public function update_transport(Request $request, $update_id){
    	$this->authLogin();  
        $data= array();
        $data['vc_ten']=$request->transport_name;
        $data['vc_phi']=$request->transport_price;
        DB::table('vanchuyen')->where('vc_ma', $update_id)->update($data);
        Session::put('message','The product was added successfully.');
        return Redirect::to('/manage-transport');
    }
    public function delete_transport($delete_id){
    	$this->authLogin();  
    	DB::table('vanchuyen')->where('vc_ma', $delete_id)->delete();
    	Session::put('message','The product was deleted successfully.');
        return Redirect::to('/manage-transport');
    }
}
