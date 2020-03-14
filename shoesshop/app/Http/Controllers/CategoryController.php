<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryController extends Controller
{
     public function authLogin(){
        $admin_id = Session::get('nd_ma');
        if ($admin_id) 
            return Redirect::to('/dashboard'); 
        else 
            return Redirect::to('/admin')->send();
    }

    public function addCategory(){
        $this->authLogin();
    	return view('admin.add_category');
    }

    public function saveCategory(Request $request)
    {
        $data = array();
        $data['dm_ma'] = $request->cate_id;
        $data['dm_ten'] = $request->cate_name;
        Db::table('danhmuc')->insert($data);
        Session::put('message','The category was added successfully.');
        return Redirect::to('/manage-category');
    } 

    public function showCategory(){
        $this->authLogin();
    	$list_categories = DB::table('danhmuc')->get();
    	$manager_category = view('admin.manage_category')->with('list_cate', $list_categories);
    	return view('admin_layout')->with('admin.manage_category', $manager_category);
    	/*return view('admin.manage_category');*/
    }

    public function editCategory($category_id){
         $this->authLogin();
        $edit_categories = DB::table('danhmuc')->where('dm_ma',$category_id)->get(); //Lấy 1 sản phẩm
        $manager_category = view('admin.edit_category')->with('edit_cate',$edit_categories);
        return view('admin_layout')->with('admin.edit_category', $manager_category);
        /*return view('admin.manage_category');*/
    }

     public function updateCategory(Request $request,$category_id){
        $data = array();
        $data['dm_ma'] = $request->cate_id;
        $data['dm_ten'] = $request->cate_name;
        DB::table('danhmuc')->where('dm_ma',$category_id)->update($data);
        Session::put('message','The category was updated successfully.');
        return Redirect::to('/manage-category');
    }

    public function deleteCategory($category_id){
        DB::table('danhmuc')->where('dm_ma',$category_id)->delete();
        Session::put('message','The category was deleted successfully.');
        return Redirect::to('/manage-category');
    }
}
