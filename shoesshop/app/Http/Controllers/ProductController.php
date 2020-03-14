<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
     public function authLogin(){
        $admin_id = Session::get('nd_ma');
        if ($admin_id) 
            return Redirect::to('/dashboard'); 
        else 
            return Redirect::to('/admin')->send();
    }

    public function addProduct(){
        $this->authLogin();
        $list_brand = DB::table("danhmuc")->orderby('dm_ma','desc')->get();
        $list_cate = DB::table("thuonghieu")->orderby('th_ma','desc')->get();
        return view('admin.add_product')->with('list_cate',$list_cate)->with('list_brand',$list_brand);
    	
    }

    public function saveProduct(Request $request){

        $data = array();
        $data['sp_ten'] = $request->pro_name;
        $data['sp_donGiaBan'] = $request->pro_price;
        $data['sp_ghiChu'] = $request->pro_note;
        $data['th_ma'] = $request->pro_brand;
        $data['dm_ma'] = $request->pro_cate;
       

        //up 1 image
        $get_image = '';
        if ($request->hasFile('product_image')){
            $this->validate($request,
                                ['product_image'=>'mimes:jpg,jpeg,png,gif|max:2048',
                                ],
                                ['product_image.mimes'=>'Only accept jpg, jpeg, png, gif.',
                                 'product_image.max'=>'Max file size: 2MB.',
                                ]
                            );

            $product_image = $request->file('product_image');
            if ($product_image){
                $get_image = $product_image->getClientOriginalName();
                $destinationPath = public_path('upload/product');
                $product_image->move($destinationPath, $get_image);
                $data_img = array();
                
                $data_img['sp_ma'] = DB::table('sanpham')->insertGetId($data);               
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


    public function showProduct(){
        $this->authLogin();
        
    	$list_products = DB::table('sanpham')->join('thuonghieu','sanpham.th_ma','=','thuonghieu.th_ma')->join('danhmuc','danhmuc.dm_ma','=','sanpham.dm_ma')->join('hinhanh','hinhanh.sp_ma','=','sanpham.sp_ma')->orderby('sanpham.sp_ma','desc')->get();
        /*echo "<pre>";
        print_r($list_products);
        echo "</pre>";*/
    	$manager_product = view('admin.manage_product')->with('list_pro', $list_products);
    	return view('admin_layout')->with('admin.manage_product', $manager_product);
    }
 
    public function details_product($product_id){

         $details_product = DB::table('sanpham')->join('hinhanh','hinhanh.sp_ma','=','sanpham.sp_ma')->where('sanpham.sp_ma',$product_id)->get(); 
         $sz_product = DB::table('chitietsanpham')->where('chitietsanpham.sp_ma',$product_id)->get(); 

         return view('pages.product.show_detail')->with('details_product',$details_product)->with('sz_product',$sz_product);
    }


    //GOODS RECEIPT
    public function addGoodsReceipt()
    {
        $this->authLogin();     
        $list_products = DB::table('sanpham')->orderby('sp_ma','desc')->get();
        return  view('admin.add_receipt')->with('list_pro', $list_products);
    }

    public function saveGoodsReceipt(Request $request)
    {
        $data = array();
        $data = $request->all();
        $datapn = array();
        /*
        $datapn['pn_ngayNhap']=$request->ngayNhap;*/
        $dateTime = Carbon::parse($request->ngayNhap);

        $datapn['pn_ngayNhap'] = $dateTime->format('Y-m-d');
        $pn_id = DB::table('phieunhap')->insertGetId($datapn);

        foreach($data['group-a'] as $pro){
             $datasp = array($pro);
             $insert_data[] = $datasp;
        }
  
         $count = count($insert_data);
         echo $count.'count <br>';
        for ($i=0; $i<$count; $i++){
            $insert_datapro = $insert_data[$i];
             $count_i = count($insert_datapro);
            for ($y=0; $y<$count_i; $y++){
                $insert_datadetail = $insert_datapro[$y];
                /*dd($insert_datadetail);*/
                $data_ctsp = array();
                $data_ctsp['sp_ma']= $insert_datadetail['masp'];
                $data_ctsp['ctsp_kichCo']= $insert_datadetail['kichCo'];
                // $data_ctsp['ctsp_donGiaNhap'] = $insert_datadetail['donGiaNhap'];
                $data_ctsp['ctsp_soLuongNhap'] = $insert_datadetail['soLuongNhap'];
                $data_ctsp['ctsp_soLuongTon'] =  $insert_datadetail['soLuongNhap'];
                $data_ctsp['pn_ma'] = $pn_id;
                DB::table('chitietsanpham')->insertGetId($data_ctsp);
                echo $insert_datadetail['masp'].'<br>';
                echo $insert_datadetail['kichCo'].'<br>';
                echo $insert_datadetail['soLuongNhap'].'<br>';
                /*echo $insert_datadetail['donGiaNhap'].'<br>';*/

            }   
        }
            
    }

    //Lan
    public function chinhsua_sanpham($chinhsua_sp_ma){
        $this->authLogin();    
        $list_cate = DB::table("danhmuc")->orderby('dm_ma','desc')->get();
        $list_brand = DB::table("thuonghieu")->orderby('th_ma','desc')->get();
        $hinh_anh=DB::table('hinhanh')->where('sp_ma', $chinhsua_sp_ma)->get();
        $edit_pro=DB::table('sanpham')->where('sp_ma',$chinhsua_sp_ma)->get();
       
        // echo $hinh_anh;
        return view('admin.edit_product')->with('edit_pro', $edit_pro)->with('list_brand', $list_brand)->with('list_cate', $list_cate)->with('hinh_anh', $hinh_anh);
    }
    public function capnhat_sanpham(Request $request, $chinhsua_sp_ma){
        $data= array();
        $data['sp_ten']=$request->pro_name;
        $data['sp_donGiaNhap']=$request->pro_pricegor;
        $data['sp_donGiaBan']=$request->pro_price;
        $data['sp_ghiChu']=$request->pro_note;
        $data['th_ma']=$request->pro_brand;
        $data['dm_ma']=$request->pro_cate;

        if ($request->hasFile('pro_image')){
            $this->validate($request,
                                ['product_image'=>'mimes:jpg,jpeg,png,gif|max:2048',
                                ],
                                ['product_image.mimes'=>'Only accept jpg, jpeg, png, gif.',
                                 'product_image.max'=>'Max file size: 2MB.',
                                ]
                            );

            $product_image = $request->file('pro_image');
            if ($product_image){
                $get_image = $product_image->getClientOriginalName();
                $destinationPath = public_path('upload/product');
                $product_image->move($destinationPath, $get_image);
                $data_img = array();
               
                $data_img['sp_ma'] = DB::table('sanpham')->insertGetId($data);              
                $data_img['ha_ten']=$get_image;
                DB::table('hinhanh')->where('sp_ma', $chinhsua_sp_ma)->update($data_img);
            }
           
           
        }
        DB::table('sanpham')->where('sp_ma', $chinhsua_sp_ma)->update($data);
        Session::put('message','The product was added successfully.');
        return Redirect::to('/manage-product');
    }

}
