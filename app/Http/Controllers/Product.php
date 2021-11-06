<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
Session_start();

class Product extends Controller
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
   public function add_product(){
    $this->Kiemtralogin();
        $cate_product=DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
        
    }
    public function all_product(){
        $this->Kiemtralogin();
        $all_product=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
        $manage_product=view('admin.all_product')->with('all_product',$all_product);
         return view('admin_layout')->with('admin.all_product',$manage_product);
    }
    public function save_product(Request $request){
        $this->Kiemtralogin();
        $data=array();
        $data['product_name'] = $request->product_name;
        $data['product_gia'] = $request->product_gia;
        $data['product_mota'] = $request->product_mota;
        $data['product_content'] = $request->product_content;
        $data['product_status'] = $request->product_status;
        $data['category_id'] = $request->cate_product;
        $data['brand_id'] = $request->brand_product; 
        $data['product_hinhanh']=$request->product_hinhanh;
        $get_hinhanh=$request->file('product_hinhanh');
        if($get_hinhanh){
        $get_name_hinhanh=$get_hinhanh->getClientOriginalName();
        $name_hinhanh=current(explode('.',$get_name_hinhanh));
        $new_hinhanh = $name_hinhanh.'.'.rand(0,99).'.'.$get_hinhanh->getClientOriginalExtension();
        $get_hinhanh->move('public/uploads/product',$new_hinhanh);
        $data['product_hinhanh']=$new_hinhanh;
        DB::table('tbl_product')->insert($data);
        Session::put('messages','Thêm thành công');
        return redirect::to('add-product');
        }
       $data['product_hinhanh']='';
        DB::table('tbl_product')->insert($data);
        Session::put('messages','không thành công');
        return redirect::to('add-product');
    }
    public function unactive_product($product_id){
        $this->Kiemtralogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('messages','Ẩn sản phẩm thành công');
        return redirect::to('all-product');

    }
    public function active_product($product_id){
        $this->Kiemtralogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
         Session::put('messages','Kích hoạt sản phẩm thành công');
         return redirect::to('all-product');
    }
    public function edit_product($product_id){
        $this->Kiemtralogin();
         $cate_product=DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $edit_product=DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manage_product=view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);
        return view('admin_layout')->with('admin.edit_product',$manage_product);
    }
    public function delete_product($product_id){
        $this->Kiemtralogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('messages','Xóa sản phẩm thành công');
        return redirect::to('all-product');

    }
    public function update_product(Request $request,$product_id){
        $this->Kiemtralogin();
        $data=array();
       $data['product_name'] = $request->product_name;
        $data['product_gia'] = $request->product_gia;
        $data['product_mota'] = $request->product_mota;
        $data['product_content'] = $request->product_content;
        $data['product_status'] = $request->product_status;
        $data['category_id'] = $request->cate_product;
        $data['brand_id'] = $request->brand_product;

        $get_hinhanh=$request->file('product_hinhanh');
        if($get_hinhanh){
        $get_name_hinhanh=$get_hinhanh->getClientOriginalName();
        $name_hinhanh=current(explode('.',$get_name_hinhanh));
        $new_hinhanh = $name_hinhanh.'.'.rand(0,99).'.'.$get_hinhanh->getClientOriginalExtension();
        $get_hinhanh->move('public/uploads/product',$new_hinhanh);
        $data['product_hinhanh']=$new_hinhanh;
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('messages','Cập nhật sản phẩm thành công');
        return redirect::to('all-product');
        }
      
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('messages','Cập nhật sản phẩm thành công');
        return redirect::to('all-product');


    }
    //hien thi chi tiet
    public function details_product($product_id){
        $all_banner=DB::table('tbl_banner')->where('banner_status','1')->orderby('banner_id','ASC')->get();
    $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
    $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
    $details_product=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();
    foreach ($details_product as $key => $value){
        $cate_id=$value->category_id;
    }

      $related_product=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$cate_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();
    return view('pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)->with('details',$details_product)->with('related',$related_product)->with('all_banner',$all_banner);
    }
}
