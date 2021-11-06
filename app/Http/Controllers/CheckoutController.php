<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;
Session_start();
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;

class CheckoutController extends Controller
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
    public function login_checkout(){
        $all_banner=DB::table('tbl_banner')->where('banner_status','1')->orderby('banner_id','ASC')->get();
         $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('all_banner',$all_banner);
    }
    public function add_customer(Request $request){
        $data=array();
        $data['customers_name']=$request->customers_name;
        $data['customers_email']=$request->customers_email;
        $data['customers_password']=md5($request->customers_password);
        $data['customers_phone']=$request->customers_phone;

        $customers_id =DB::table('tbl_customers')->insertGetId($data);
        Session::put('customers_id',$customers_id);
        Session::put('customers_name',$request->customers_name);
        return redirect('/checkout');
    }
    public function checkout(){
        $all_banner=DB::table('tbl_banner')->where('banner_status','1')->orderby('banner_id','ASC')->get();
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('all_banner',$all_banner);
    }
    public function save_checkout_customers(Request $request){
        // $data=array();
        // $data['shipping_name']=$request->shipping_name;
        // $data['shipping_address']=$request->shipping_address;
        // $data['shipping_phone']=$request->shipping_phone;
        // $data['shipping_email']=$request->shipping_email;
        // $data['shipping_note']=$request->shipping_note;

        // $shipping_id =DB::table('tbl_shipping')->insertGetId($data);
        // Session::put('shipping_id',$shipping_id);
         
        // return redirect('/payment');
    }
    public function payment(){
        $all_banner=DB::table('tbl_banner')->where('banner_status','1')->orderby('banner_id','ASC')->get();
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product)->with('all_banner',$all_banner);
    }
    public function logout_checkout(){
        Session::flush();
        return redirect('/login-checkout');
    }
    public function login_customer(Request $request){
        $email=$request->email_acc;
        $pass=md5($request->pass_acc);
        $result=DB::table('tbl_customers')->where('customers_email',$email)->where('customers_password',$pass)->first();
       
        if($result){
             Session::put('customers_id',$result->customers_id);
             Session::put('customers_name',$result->customers_name);
             return redirect('/checkout');
              }else{
                Session::put('messages','Mật khẩu hoặc tên đăng nhập không đúng');
                 return redirect('/login-checkout');
              }
          
      
       
    }
    public function order_play(Request $request){
        //ínsertpayment
        $data=array();
        $data['payment_method']=$request->payment_option;
        $data['payment_status']='Đang chờ xử lý';

        $payment_id =DB::table('tbl_payment')->insertGetId($data);

         //insertorder
        $order_data=array();
        $order_data['customer_id']=Session::get('customers_id');
        $order_data['shipping_id']=Session::get('shipping_id');
        $order_data['payment_id']=$payment_id;
        $order_data['order_total']=Cart::total();
        $order_data['order_status']='Đang chờ xử lý';

        $order_id =DB::table('tbl_order')->insertGetId($order_data);

        //insert_order_details
        $content=Cart::content();
        foreach($content as $v_content){
            $order_details_data['order_id']=$order_id;
            $order_details_data['product_id']=$v_content->id;
            $order_details_data['product_name']=$v_content->name;
            $order_details_data['product_price']=$v_content->price;
            $order_details_data['product_sales_quantity']=$v_content->qty;
            DB::table('tbl_order_details')->insert($order_details_data);
        }
        if($data['payment_method']==0){
            echo 'Thanh toán online';
        }else{
            Cart::destroy();
            $all_banner=DB::table('tbl_banner')->where('banner_status','1')->orderby('banner_id','ASC')->get();
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product)->with('all_banner',$all_banner);
        }
       //return redirect('/payment');
    }
    public function manage_order(){
         $this->Kiemtralogin();
        $all_order=DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customers_id')
        ->select('tbl_order.*','tbl_customers.customers_name')
        ->orderby('tbl_order.order_id','desc')->get();
        $manage_order=view('admin.manage_order')->with('all_order',$all_order);
         return view('admin_layout')->with('admin.manage_order',$manage_order);
        
    }
    public function view_order($orderId){
          $this->Kiemtralogin();
        $order_by_id=DB::table('tbl_order')
         ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customers_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*')
        ->first();
     
        $manage_order_by_id=view('admin.view_order')->with('order_by_id',$order_by_id);
         return view('admin_layout')->with('admin.view_order',$manage_order_by_id);
       
    }
    public function insert_shipping(Request $request){
        $data=array();
        $data['shipping_name']=$request->shipping_name;
        $data['shipping_address']=$request->shipping_address;
        $data['shipping_phone']=$request->shipping_phone;
        $data['shipping_email']=$request->shipping_email;
        $data['shipping_note']=$request->shipping_note;
        $data['shipping_method']=$request->shipping_method;

        $shipping_id =DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id',$shipping_id);

        $checkout_code=substr(md5(microtime()),rand(0,26),5);
        $order=array();
        $order['customer_id']=Session::get('customers_id');
        $order['shipping_id']=$shipping_id;
        $order['order_status']=1;
        $order['order_code']=$checkout_code;
        $order['created_at']=now();
        $order_id=DB::table('tbl_order')->insertGetId($order);      

        
        if(Session::get('cart')){

            foreach(Session::get('cart') as $key =>$cart){
                $order_detail=array();
                $order_detail['order_code']=$checkout_code;
                $order_detail['product_id']=$cart['product_id'];
                $order_detail['product_name']=$cart['product_name'];
                $order_detail['product_price']=$cart['product_gia'];
                $order_detail['product_sales_quantity']=$cart['product_qty'];
                $order_detail['created_at']=now();
                DB::table('tbl_order_details')->insert($order_detail);
            }
        }
        Session::forget('cart');
    }
}
