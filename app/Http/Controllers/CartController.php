<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
Session_start();

class CartController extends Controller
{
    public function delete_product_cart($session_id){
        $cart=Session::get('cart');
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');
        }else{
            return redirect()->back()->with('message','Xóa sản phẩm thất bại');
        }
    }
    public function update_cart(Request $request){
        $data= $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            foreach($data['cart_qty'] as $key => $qty){
                foreach($cart as $session => $val){
                    if($val['session_id']==$key){
                        $cart[$session]['product_qty']=$qty;
                    }
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Cập nhật thành công');
        }else{
            return redirect()->back()->with('message','Không thành công');
        }
    }
    public function gio_hang(Request $request){
           $all_banner=DB::table('tbl_banner')->where('banner_status','1')->orderby('banner_id','ASC')->get();
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
         return view('pages.cart.cart_ajax')->with('category',$cate_product)->with('brand',$brand_product)->with('all_banner',$all_banner);
    }
    public function add_cart_ajax(Request $request){
        $data= $request->all();
        $session_id=substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key =>$val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable ++;
                }
            }
            if($is_avaiable == 0){
            $cart[]=array(
                'session_id'=>$session_id,
                'product_name'=>$data['cart_product_name'],
                'product_id'=>$data['cart_product_id'],
                'product_gia' =>$data['cart_product_gia'],
                'product_hinhanh'=>$data['cart_product_hinhanh'],
                'product_qty'=>$data['cart_product_qty'],
            );  
            Session::put('cart',$cart);  
            }
        }else{
            $cart[]=array(
                'session_id'=>$session_id,
                'product_name'=>$data['cart_product_name'],
                'product_id'=>$data['cart_product_id'],
                'product_gia' =>$data['cart_product_gia'],
                'product_hinhanh'=>$data['cart_product_hinhanh'],
                'product_qty'=>$data['cart_product_qty'],
            );
            Session::put('cart',$cart);
        }
        
        Session::save();
    }
    
    public function save_cart(Request $request){
       $product_id= $request->productid_hidden;
        $quantity= $request->qty;
        $product_info= DB::table('tbl_product')->where('product_id',$product_id)->first(); 
      
        //Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        $data['id']=$product_info->product_id;
        $data['qty']=$quantity;
        $data['name']=$product_info->product_name;
        $data['price']=$product_info->product_gia;
        $data['weight']='123';
        $data['options']['image']=$product_info->product_hinhanh;
        Cart::add($data);

       return Redirect::to('/show-cart');
    }
    public function show_cart(){
        $all_banner=DB::table('tbl_banner')->where('banner_status','1')->orderby('banner_id','ASC')->get();
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
         return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product)->with('all_banner',$all_banner);
    }
    public function delete_to_cart($RowId){
        Cart::update($RowId,0);
        return Redirect::to('/show-cart');
    }
    public function update_cart_qty(Request $request){
        $RowId=$request->rowId_cart;
        $qty=$request->cart_qty;
        Cart::update($RowId,$qty);
        return Redirect::to('/show-cart');
    }
}
