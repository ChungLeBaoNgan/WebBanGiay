<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Mail;
use Illuminate\Support\Facades\Redirect;

class ResetPasswordController extends Controller
{
    public function email_resetpass(){
    	return view('pages.customer.user_email_resetpass');
    }

    public function post_email_resetpass(Request $request){
    	$email_reset = $request->user_email_reset;

    	$result = DB::table('nguoidung')->where('nd_email', $email_reset)->first();
    	Session::put('nd_email',$result->nd_email);
    	$email=Session::get('nd_email');
    	if($result){

    		$data=array();
			$data['nd_matKhau_reset'] = md5($email_reset);
			Db::table('nguoidung')->where('nd_email', $email_reset)->update($data);
			
			Mail::send('pages.customer.user_reset_password',array('email'=>$request->user_email_reset), function($message){
	         	$message->to($email, 'LMNT ShoesShop')->subject('Lấy lại mật khẩu');
	    });
        		//Thêm thông báo sau
        		// Session::put('success','Link lấy lại mật khẩu đã được gửi đến mail của bạn.');
        	return view('pages.customer.user_resetpass');
    	}else{
    		Session::put('message','Email không tồn tại.');
                return Redirect::to('/email_resetpass');
    	}
    }

    public function resetpass(){
    	return view('pages.customer.user_resetpass');
    }

    public function post_resetpass(Request $request){
    	
    }
}
