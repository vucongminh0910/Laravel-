@extends('layout')
@section('content')
<div class=""><!--features_items-->
						<h2 class="title text-center" style="color: #126E22;">Sản Phẩm Mới</h2>
						@foreach($all_product as $key => $pro)
						
						<div class="col-sm-4">
							<div class="product-image-wrapper">	
								
									<div class="single-products">
										<div class="productinfo text-center">
											<form>
												{{csrf_field()}}
												<input type="hidden"  value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
												<input type="hidden"  value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
												<input type="hidden" value="{{$pro->product_gia}}" class="cart_product_gia_{{$pro->product_id}}">
												<input type="hidden"  value="{{$pro->product_hinhanh}}" class="cart_product_hinhanh_{{$pro->product_id}}">
												<input type="hidden"  value="1" class="cart_product_qty_{{$pro->product_id}}">

											<a href="{{URL::to('chi-tiet-san-pham/'.$pro->product_id)}}">
											<img src="{{URL::to('public/uploads/product/'.$pro->product_hinhanh)}}" width="100px" height="270px" alt="" />
											<h2>{{number_format($pro->product_gia).' '.'VND'}}</h2>
											<p>{{$pro->product_name}}</p>
											
										</a>
											<button type="button" class="btn btn-success add-to-cart" data-id_product="{{$pro->product_id}}" name="add-to-cart">Thêm giỏ hàng</button>
											</form>
										</div>	
								</div>
									
							</div>
						</div>
						@endforeach
						
							
</div><!--features_items-->



					
					@endsection