<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Cart;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//fontend
Route::get('/','HomeController@index');
//mail
Route::get('/send-mail','HomeController@sendmail');

Route::get('/trang-chu','HomeController@index');
Route::post('/tim-kiem','HomeController@search');

//danh muc san pham trang chu
Route::get('/danh-muc-san-pham/{category_id}','CategoryProduct@show_category_home');
 
//thuong hieu trang chu
 Route::get('/thuong-hieu-san-pham/{brand_id}','BrandProduct@show_brand_home');

 //chi tiet san pham
  Route::get('/chi-tiet-san-pham/{product_id}','Product@details_product');




//backend
Route::get('/admin','Admincontroller@admin');
Route::get('/dashboard','Admincontroller@showadmin');
Route::get('/logout','Admincontroller@logout');
Route::get('/login-facebook','Admincontroller@login_facebook');
Route::get('/admin/callback','Admincontroller@callback_facebook');

Route::get('/login-google','Admincontroller@login_google');
Route::get('/google/callback','Admincontroller@callback_google');

Route::post('/admin-dashboard','Admincontroller@dashboard');
//category-product
Route::get('/add-category-product','CategoryProduct@add_category_product');
Route::get('/all-category-product','CategoryProduct@all_category_product');
Route::get('/edit-category-product/{category_product_id}','CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','CategoryProduct@delete_category_product');


Route::get('/unactive-category-product/{category_product_id}','CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}','CategoryProduct@active_category_product');


Route::post('/save-category-product','CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}','CategoryProduct@update_category_product');


//brand-product
Route::get('/add-brand-product','BrandProduct@add_brand_product');
Route::get('/all-brand-product','BrandProduct@all_brand_product');
Route::get('/edit-brand-product/{brand_product_id}','BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','BrandProduct@delete_brand_product');


Route::get('/unactive-brand-product/{brand_product_id}','BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','BrandProduct@active_brand_product');


Route::post('/save-brand-product','BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}','BrandProduct@update_brand_product');


//Product
Route::get('/add-product','Product@add_product');
Route::get('/all-product','Product@all_product');
Route::get('/edit-product/{product_id}','Product@edit_product');
Route::get('/delete-product/{product_id}','Product@delete_product');


Route::get('/unactive-product/{product_id}','Product@unactive_product');
Route::get('/active-product/{product_id}','Product@active_product');


Route::post('/save-product','Product@save_product');
Route::post('/update-product/{product_id}','Product@update_product');

//cart
Route::post('/save-cart','CartController@save_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/gio-hang','CartController@gio_hang');
Route::post('/add-cart-ajax','CartController@add_cart_ajax');


Route::get('/delete-to-cart/{RowId}','CartController@delete_to_cart');
Route::post('/update-cart-qty','CartController@update_cart_qty');
Route::post('/update-cart','CartController@update_cart');
Route::get('/delete-product-cart/{session_id}','CartController@delete_product_cart');

//check-out
Route::get('/login-checkout','CheckoutController@login_checkout');
Route::get('/logout-checkout','CheckoutController@logout_checkout');
Route::post('/add-customer','CheckoutController@add_customer');
Route::post('/order-play','CheckoutController@order_play');
Route::post('/login-customer','CheckoutController@login_customer');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save-checkout-customers','CheckoutController@save_checkout_customers');
Route::get('/payment','CheckoutController@payment');
Route::post('/insert-shipping','CheckoutController@insert_shipping');
//oder
Route::get('/manage-order','OrderController@manage_order');
Route::get('/view-order/{order_code}','OrderController@view_order');
Route::get('/don-hang/{customers_id}','OrderController@don_hang');
Route::get('/xacnhan-order/{order_code}','OrderController@xacnhan_order');
Route::get('/huy-order/{order_code}','OrderController@huy_order');


//banner
Route::get('/add-banner','Banner@add_banner');
Route::get('/manage-banner','Banner@manage_banner');
Route::post('/save-banner','Banner@save_banner');
Route::get('/unactive-banner/{banner_id}','Banner@unactive_banner');
Route::get('/active-banner/{banner_id}','Banner@active_banner');
Route::get('/delete-banner/{banner_id}','Banner@delete_banner');