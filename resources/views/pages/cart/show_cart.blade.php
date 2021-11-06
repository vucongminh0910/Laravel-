@extends('layout')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<h2 class="title text-center" style="color: #126E22;">Giỏ hàng</h2>
			</div>
			<div class="table-responsive cart_info">
				<?php 
				$content= Cart::content();
			
				 ?>
				<table class="table table-condensed">
					<thead>
						<tr class="menu" style="background: #126E22;">
							<td class="image" style="color:white;">Hình ảnh </td>
							<td class="description" style="color:white;">Mô tả</td>
							<td class="price" style="color:white;">Giá</td>
							<td class="quantity" style="color:white;">Số lượng</td>
							<td class="total" style="color:white;">Tổng</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($content as  $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" width="50px" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
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
		</div>
	</section> <!--/#cart_items-->
	<section id="do_action">
		<div class="container">
			
			<div class="row">
	
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng  <span>{{Cart::total().''.'VND'}}</span></li>
							<li>Thuế <span>{{Cart::tax().''.'VND'}}</span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Thành tiền <span>{{Cart::total().''.'VND'}}</span></li>
						</ul>
							  <?php 
                                    $customers_id=Session::get('customers_id');
                                    if($customers_id!=NULL){
                                    
                                    ?>
                                   <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>
                                    
                                <?php }else{ ?>
                                  <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
                                <?php } ?>
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection