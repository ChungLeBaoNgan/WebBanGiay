<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Validator;
session_start();
class HomeController extends Controller
{
    // Ngân (11/3/2020) paste lại nguyên cái public authLogin
    public function authLogin(){
        $cv=Session::get('cv_ma');
        if ($cv==2) 
            return Redirect::to('/Home_u'); 
        else 
            return Redirect::to('/userLogin')->send();
    }
    public function index()
    {
        // Tiên
        $all_product = DB::table('sanpham')->join('hinhanh','hinhanh.sp_ma','=','sanpham.sp_ma')->orderby('sanpham.sp_ma','desc')->limit(4)->get(); 
        return view("pages.home")->with('all_product',$all_product);
    }

     public function userLogin(){
        return view('pages.customer.user_login');
    }

    public function Home_u(){
        $this->authLogin();
        $all_product = DB::table('sanpham')->join('hinhanh','hinhanh.sp_ma','=','sanpham.sp_ma')->orderby('sanpham.sp_ma','desc')->limit(4)->get(); 
        return view("pages.home")->with('all_product',$all_product);
    }

    public function get_register(){
        return view('pages.customer.user_register');
    }

    public function post_register(Request $req){
        
        $validate = Validator::make($req->all(),[
            'user_birth'=>'date',
            'user_phone'=>'numeric',
            'user_email'=>'email',
            'user_password'=>'min:3|max:28',
            'user_confirm_pass'=>'same:user_password',
            ],[
            'user_birth.date'=>'Ngày sinh phải theo định dạng năm/tháng/ngày', 
            'user_phone.numeric'=>'Số điện thoại phải là số.',
            'user_email.email'=>'Emails chưa nhập đúng định dạng abc@gmai.com',
            'user_password.min'=>'Mật khẩu không nhỏ hơn 3 ký tự',
            'user_password.max'=>'Mật khẩu không lớn hơn 28 ký tự',]);
        if ($validate->fails()) {
            return View('pages.customer.user_register')->withErrors($validate);
        }

        $data=array();

        $data['nd_ten'] = $req->user_name;
        $data['nd_ngaySinh'] = $req->user_birth;
        $data['nd_email'] = $req->user_email;
        $data['nd_dienThoai'] = $req->user_phone;
        $data['nd_diaChi'] = $req->user_address;
        $data['cv_ma'] = "2"; //Chuc vu Khach hang
        $data['nd_trangThai'] = "0"; //Trạng thái tài khoản (không vô hiệu) Ngân(6/3/2020)
        if($req->rdGioitinh=="Male"){
            $data['nd_gioiTinh'] = 0;
        }
        else{
            $data['nd_gioiTinh'] = 1;
        }
        $data['nd_matKhau'] = md5($req->user_password);
        $data['nd_matKhau_reset'] = "";

        $customer_id = DB::table('nguoidung')->insertGetId($data);

        Session::put('nd_ma',$customer_id);
        Session::put('nd_ten',$req->user_name);
        Session::put('cv_ma',2);
        return Redirect::to('/Home_u');
    }


     public function AfterLogin(Request $request){
       
        $validate = Validator::make($request->all(),[
            'user_email'=>'email',
            'user_password'=>'min:3|max:28',
            ],[
            'user_email.email'=>'Email chưa nhập đúng định dạng abc@gmai.com',
            'user_password.min'=>'Mật khẩu không nhỏ hơn 3 ký tự',
            'user_password.max'=>'Mật khẩu không lớn hơn 28 ký tự',]);
        if ($validate->fails()) {
            return View('pages.customer.user_login')->withErrors($validate);
        }
        // if (Auth::attempt(['email'=>$request->admin_email, 'password'=>$request->admin_password]))
        // {
            $user_email = $request->user_email; // request trỏ tới tên thẻ
            $user_password = md5($request->user_password);

            $result = DB::table('nguoidung')->where('nd_email', $user_email)->where('nd_matKhau',$user_password)->first();
            /*echo '<pre>';
            print_r($result);
            echo '</pre>';*/
            /*return view('admin.dashboard');*/
            if ($result) {
                Session::put('cv_ma',$result->cv_ma);
                $cv=Session::get('cv_ma');
                if($cv==2){
                    Session::put('nd_ma', $result->nd_ma); // result trỏ tới trường csdl
                    Session::put('nd_ten',$result->nd_ten);
                    Session::put('nd_email',$result->nd_email);
                        return Redirect::to('/Home_u');
                }else{
                    Session::put('message1','Bạn không có quyền truy cập.');
                        return Redirect::to('/userLogin');
                }
            }    
            else {
                
                Session::put('message','Email hoặc mật khẩu không đúng. Vui lòng thử lại');
                return Redirect::to('/userLogin');
            }
            
        //}
    }


    public function log_out(){
        $this->authLogin();
        Session::put('nd_ma',null);
        Session::put('nd_ten',null);
        Session::put('cv_ma',null);
        Session::put('nd_email',null);
        return Redirect::to('/');
       /* return Redirect::to('/userLogin');*/
                //echo "Logout";
    }
}
