<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
Session_start();
class Banner extends Controller
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
    public function manage_banner(){
        $this->Kiemtralogin();
        $all_banner=DB::table('tbl_banner')->orderby('banner_id','DESC')->get();
        return view('admin.banner.manage_banner')->with('all_banner',$all_banner);
    }
    public function add_banner(){
        $this->Kiemtralogin();
        $cate_product=DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->orderby('brand_id','desc')->get();
            return view('admin.banner.add_banner')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    public function save_banner(Request $request){
        $this->Kiemtralogin();
        $data=array();
        $data['banner_name']=$request->banner_name;
        $data['banner_content']=$request->banner_content;
        $data['banner_status']=$request->banner_status;
        $data['banner_img']=$request->banner_hinhanh;
        $get_hinhanh=$request->file('banner_hinhanh');
        if($get_hinhanh){
        $get_name_hinhanh=$get_hinhanh->getClientOriginalName();
        $name_hinhanh=current(explode('.',$get_name_hinhanh));
        $new_hinhanh = $name_hinhanh.'.'.rand(0,99).'.'.$get_hinhanh->getClientOriginalExtension();
        $get_hinhanh->move('public/uploads/product',$new_hinhanh);
        $data['banner_img']=$new_hinhanh;
        DB::table('tbl_banner')->insert($data);
        Session::put('messages','Thêm thành công');
        return redirect::to('add-banner');
            }
            $data['banner_img']='';
            DB::table('tbl_banner')->insert($data);
            Session::put('messages','không thêm ảnh thành công');
            return redirect::to('add-banner');
    }
    public function unactive_banner($banner_id){
        $this->Kiemtralogin();
        DB::table('tbl_banner')->where('banner_id',$banner_id)->update(['banner_status'=>0]);
        Session::put('messages','Ẩn banner thành công');
        return redirect::to('manage-banner');

    }
    public function active_banner($banner_id){
        $this->Kiemtralogin();
        DB::table('tbl_banner')->where('banner_id',$banner_id)->update(['banner_status'=>1]);
         Session::put('messages','Kích hoạt banner thành công');
         return redirect::to('manage-banner');
    }
    public function delete_banner($banner_id){
        $this->Kiemtralogin();
        DB::table('tbl_banner')->where('banner_id',$banner_id)->delete();
        Session::put('messages','Xóa banner thành công');
        return redirect::to('manage-banner');
    }
}
