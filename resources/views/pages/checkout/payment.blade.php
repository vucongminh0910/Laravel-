@extends('layout')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Trang thông tin đơn hàng</li>
				</ol>
			</div>
			

			
		
			

			
			<div class="review-payment">
				<h2>Xem lại giỏ hàng</h2>
			</div><br>

			<div class="table-responsive cart_info">
	
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh </td>
							<td class="description">Mô tả</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
							@foreach(Session::get('shipping_id') as $key =>$ship)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" width="50px" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$ship->name}}</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price).' '.'VND'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/update-cart-qty')}}" method="POST">
									{{csrf_field()}}
									<input class="cart_quantity_input" type="text" name="cart_qty" value="{{$v_content->qty}}" autocomplete="off" size="2">
									<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart">
									<input type="submit" value="Cập nhật" name="upadte_qty" class="btn btn-default btn-sm">
								</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									<?php 
										$tong=$v_content->price * 	$v_content->qty;
										echo number_format($tong).''.'VND';
									?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
						
					</tbody>
				</table>
			</div>
			<h4 style="margin: 40px 0; font-size:20px" >Chọn hình thức thanh toán</h4>
			<form action="{{URL::to('/order-play')}}" method="POST">
				{{csrf_field()}}
			<div class="payment-options">
					<span>
						<label><input  name="payment_option" value="0" type="checkbox">Thanh toán online</label>
					</span>
					<span>
						<label><input name="payment_option" value="1" type="checkbox">Trả tiền sau khi nhận hàng</label>
					</span>
					<input type="submit" value="Đặt hàng" name="send_order_play" class="btn btn-primary btn-sm">
				</div>
			</form>
		</div>
	</section>
@endsection