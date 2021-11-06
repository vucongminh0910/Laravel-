@extends('layout')
@section('content')
<div class="features_items">
						<h2 class="title text-center" style="color:#126E22">Kết Quả Tìm kiếm</h2>
						 @foreach($search_product as $key => $pro)
						<a href="{{URL::to('chi-tiet-san-pham/'.$pro->product_id)}}">
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{URL::to('public/uploads/product/'.$pro->product_hinhanh)}}" width="100px" height="270px" alt="" />
											<h2>{{number_format($pro->product_gia).' '.'VND'}}</h2>
											<p>{{$pro->product_name}}</p>
											<a href="#" class="btn btn-success add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
										</div>	
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
						
						
</div>
@endsection