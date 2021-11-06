<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
Session_start();

class BrandProduct extends Controller
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
   public function add_brand_product(){
        $this->Kiemtralogin();
        return view('admin.add_brand_product');
    }
    public function all_brand_product(){
         $this->Kiemtralogin();
        $all_brand_product=DB::table('tbl_brand')->get();
        $manage_brand_product=view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
         return view('admin_layout')->with('admin.all_brand_product',$manage_brand_product);
    }
    public function save_brand_product(Request $request){
         $this->Kiemtralogin();
        $data=array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_mota'] = $request->brand_product_mota;
        $data['brand_status'] = $request->brand_product_status;
        DB::table('tbl_brand')->insert($data);
        Session::put('messages','Thêm thành công');
        return redirect::to('add-brand-product');
    }
    public function unactive_brand_product($brand_product_id){
         $this->Kiemtralogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('messages','Ẩn thương hiệu thành công');
        return redirect::to('all-brand-product');

    }
    public function active_brand_product($brand_product_id){
         $this->Kiemtralogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
         Session::put('messages','Kích hoạt thương hiệu thành công');
         return redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id){
         $this->Kiemtralogin();
        $edit_brand_product=DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        $manage_catgory_product=view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product',$manage_catgory_product);
    }
    public function delete_brand_product($brand_product_id){
         $this->Kiemtralogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        Session::put('messages','Xóa danh mục thành công');
        return redirect::to('all-brand-product');

    }
    public function update_brand_product(Request $request,$brand_product_id){
         $this->Kiemtralogin();
        $data=array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_mota'] = $request->brand_product_mota;
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
        Session::put('messages','Cập nhật danh mục thành công');
        return redirect::to('all-brand-product');


    }


    //ham show brand trang chu

     public function show_brand_home($brand_id){
     $all_banner=DB::table('tbl_banner')->where('banner_status','1')->orderby('banner_id','ASC')->get();
      $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
      $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
      $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_product.brand_id',$brand_id)->limit(6)->get();
       $name_brand=DB::table('tbl_brand')->where('tbl_brand.brand_id',$brand_id)->get();
      return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with('name_brand',$name_brand)->with('all_banner',$all_banner);
    }

}
