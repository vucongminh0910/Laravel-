<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;

class OrderController extends Controller
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
    public function manage_order(){
        $order=DB::table('tbl_order')->orderby('created_at','DESC')->get();
        return view('admin.manage_order')->with('order',$order);
    }

    public function view_order($order_code){
        $order_mana=DB::table('tbl_order')->where('order_code',$order_code)->get();
        foreach($order_mana as $key =>$cus){
            $customers_id=$cus->customer_id;
            $shipping_id=$cus->shipping_id;
        }
        $customer=DB::table('tbl_customers')->where('customers_id',$customers_id)->first();
        $shipping=DB::table('tbl_shipping')->where('shipping_id',$shipping_id)->first();
        $details=DB::table('tbl_order_details')->where('order_code',$order_code)->get();
        return view('admin.view_order')->with('order_mana',$order_mana)->with('customer',$customer)->with('shipping',$shipping)->with('details',$details);
    }
    public function don_hang($customers_id){
         $all_banner=DB::table('tbl_banner')->where('banner_status','1')->orderby('banner_id','ASC')->get();
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $details=DB::table('tbl_order')->where('customer_id',$customers_id)->join('tbl_customers','tbl_customers.customers_id','=','tbl_order.customer_id')->join('tbl_order_details','tbl_order_details.order_code','=','tbl_order.order_code')->orderby('order_id','DESC')->get();

       

        return view('pages.order.order_customer')->with('category',$cate_product)->with('brand',$brand_product)->with('all_banner',$all_banner)->with('details',$details);
    }
    public function xacnhan_order($order_code){
     
        DB::table('tbl_order')->where('order_code',$order_code)->update(['order_status'=>0]);
        Session::put('messages','Xác nhận đơn hàng thành công');
        return redirect::to('manage-order');
    }
    public function huy_order($order_code){
     
        DB::table('tbl_order')->where('order_code',$order_code)->update(['order_status'=>1]);
        Session::put('messages','Đã hủy xác nhận đơn hàng');
        return redirect::to('manage-order');
    }
}

