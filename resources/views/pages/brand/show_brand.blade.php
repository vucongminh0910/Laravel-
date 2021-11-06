@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
		@foreach($name_brand as $key => $ten_brand)
						<h2 class="title text-center">{{$ten_brand->brand_name}}</h2>
						@endforeach
						@foreach($brand_by_id as $key => $pro)
						<a href="{{URL::to('chi-tiet-san-pham/'.$pro->product_id)}}">
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
										
											<img src="{{URL::to('public/uploads/product/'.$pro->product_hinhanh)}}" width="100px" height="270px" alt="" />
											<h2>{{number_format($pro->product_gia).' '.'VND'}}</h2>
											<p>{{$pro->product_name}}</p></a>
											<button type="button" class="btn btn-success add-to-cart" data-id_product="{{$pro->product_id}}" name="add-to-cart">Thêm giỏ hàng</button>
										</div>
									</form>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Thêm yêu thích</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Thêm so sánh</a></li>
									</ul>
								</div>
							</div>
						</div>
					
						@endforeach
						
						
					</div><!--features_items-->



					
@endsection