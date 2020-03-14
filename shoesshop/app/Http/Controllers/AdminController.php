<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
session_start();

class AdminController extends Controller
{
    // Ngân (11/3/2020) paste lại nguyên cái public authLogin
    public function authLogin(){
        
        $cv=Session::get('cv_ma');
        
        if ($cv==1) 
            return Redirect::to('/dashboard'); 
        else 
            return Redirect::to('/admin')->send();
    }

    public function index()
    {
        return view('admin_login');
    }

    public function chart()
    {
        return view('admin.chart');
    }
    public function show_dashboard(){
       $this->authLogin();
        return view('dashboard');
    }

    public function dashboard(Request $request){

        $this->validate($request, [
            'admin_email'=>'required',
            'admin_password'=>'required|min:3|max:28'
            ],[
            'admin_email.required'=>'Bạn chưa nhập Email',
            'admin_password.required'=>'Bạn chưa nhập Password',
            'admin_password.min'=>'Password không nhỏ hơn 3 ký tự',
            'admin_password.max'=>'Password không lớn hơn 28 ký tự']);
        // if (Auth::attempt(['email'=>$request->admin_email, 'password'=>$request->admin_password]))
        // {
            $admin_email = $request->admin_email; // request trỏ tới tên thẻ
            $admin_password = md5($request->admin_password);

            $result = DB::table('nguoidung')->where('nd_email', $admin_email)->where('nd_matKhau',$admin_password)->first();
            /*echo '<pre>';
            print_r($result);
            echo '</pre>';*/
            /*return view('admin.dashboard');*/
            if ($result) {
                Session::put('cv_ma',$result->cv_ma);
                $cv=Session::get('cv_ma');
                if($cv==1){
                    Session::put('nd_ma', $result->nd_ma); // result trỏ tới trường csdl
                    Session::put('nd_ten',$result->nd_ten);
                    Session::put('nd_email',$result->nd_email);
                        return Redirect::to('/dashboard');
                }else{
                    Session::put('message1','Bạn không có quyền truy cập.');
                        return Redirect::to('/admin');
                }
            }    
            else {
                Session::put('message','Email hoặc mật khẩu không đúng. Vui lòng thử lại.');
                return Redirect::to('/admin');
            }
        //}
        
        
    }
    public function logout(){
        $this->authLogin();
        Session::put('nd_ma',null);
        Session::put('nd_ten',null);
        Session::put('cv_ma',null);
        Session::put('nd_email',null);
        return Redirect::to('/admin');
        //echo "Logout";
    }
   
   
}
