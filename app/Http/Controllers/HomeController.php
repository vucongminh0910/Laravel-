<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Mail;
Session_start();

class HomeController extends Controller
{
    public function sendmail(){
      $to_name="STREETWEAR";
      $to_mail="minhvuchelsea@gmail.com";
      $data = array("name"=>"STREETWEAR","body"=>"Xác nhận đặt đơn hàng");
      Mail::send('pages.send_mail',$data,function($message) use($to_name,$to_mail){
        $message->to($to_mail)->subject('Test send mail của minh đẹp chai');
        $message->from($to_mail,$to_name);
      });
      return Redirect('/')->with('message','');
    }

    public function index(){
      $all_banner=DB::table('tbl_banner')->where('banner_status','1')->orderby('banner_id','ASC')->get();
       $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $all_product=DB::table('tbl_product')->where('product_status','0')->orderby('product_id','desc')->limit(6)->get();
       return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('all_banner',$all_banner);
    }
    public function search(Request $request){
       $all_banner=DB::table('tbl_banner')->where('banner_status','1')->orderby('banner_id','ASC')->get();
      $keywords=$request->keywords_submit;
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
       $search_product=DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();
       return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product)->with('all_banner',$all_banner);
    }
}
