<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
Session_start();

class CategoryProduct extends Controller
{
    public function Kiemtralogin(){
        $admin_id=Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_category_product(){
          $this->Kiemtralogin();
        return view('admin.add_cate_product');
    }
    public function all_category_product(){
          $this->Kiemtralogin();
        $all_category_product=DB::table('tbl_category_product')->get();
        $manage_catgory_product=view('admin.all_cate_product')->with('all_cate_product',$all_category_product);
         return view('admin_layout')->with('admin.all_cate_product',$manage_catgory_product);
    }
    public function save_category_product(Request $request){
          $this->Kiemtralogin();
        $data=array();
        $data['category_name'] = $request->category_product_name;
        $data['category_mota'] = $request->category_product_mota;
        $data['category_status'] = $request->category_product_status;
        DB::table('tbl_category_product')->insert($data);
        Session::put('messages','Thêm thành công');
        return redirect::to('add-category-product');
    }
    public function unactive_category_product($category_product_id){
          $this->Kiemtralogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('messages','Ẩn danh mục thành công');
        return redirect::to('all-category-product');

    }
    public function active_category_product($category_product_id){
          $this->Kiemtralogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
         Session::put('messages','Kích hoạt danh mục thành công');
         return redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
          $this->Kiemtralogin();
        $edit_category_product=DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manage_catgory_product=view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product',$manage_catgory_product);
    }
    public function delete_category_product($category_product_id){
          $this->Kiemtralogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('messages','Xóa danh mục thành công');
        return redirect::to('all-category-product');

    }
    public function update_category_product(Request $request,$category_product_id){
          $this->Kiemtralogin();
        $data=array();
        $data['category_name'] = $request->category_product_name;
        $data['category_mota'] = $request->category_product_mota;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('messages','Cập nhật danh mục thành công');
        return redirect::to('all-category-product');


    }

    //ham show cate home

    public function show_category_home($category_id){
      $all_banner=DB::table('tbl_banner')->where('banner_status','1')->orderby('banner_id','ASC')->get();
      $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
      $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
      $cate_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.category_id',$category_id)->limit(6)->get();
      $name_cate=DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->get();
      return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('cate_id',$cate_id)->with('name_cate',$name_cate)->with('all_banner',$all_banner);
    }
  

   
}
