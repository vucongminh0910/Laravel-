@extends('layout')
@section('content')
@foreach($details as $key => $pro)
<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{URL::to('/public/uploads/product/'.$pro->product_hinhanh)}}" alt="" />
								
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
										  <a href=""><img src="{{URL::to('/public/uploads/product/'.$pro->product_hinhanh)}}" height="50px" width="85px" alt=""></a>
										  <a href=""><img src="{{URL::to('/public/uploads/product/'.$pro->product_hinhanh)}}" height="50px" width="85px" alt=""></a>
										  <a href=""><img src="{{URL::to('/public/uploads/product/'.$pro->product_hinhanh)}}" height="50px" width="85px" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="{{URL::to('/public/uploads/product/'.$pro->product_hinhanh)}}" height="50px" width="85px"  alt=""></a>
										  <a href=""><img src="{{URL::to('/public/uploads/product/'.$pro->product_hinhanh)}}" height="50px" width="85px"  alt=""></a>
										  <a href=""><img src="{{URL::to('/public/uploads/product/'.$pro->product_hinhanh)}}" height="50px" width="85px"  alt=""></a>
										</div>
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
						
								<h2>{{$pro->product_name}}</h2>
								<p>Mã sp: {{$pro->product_id}}</p>
								<img src="images/product-details/rating.png" alt="" />

								<form>
									{{csrf_field()}}
												<input type="hidden"  value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
												<input type="hidden"  value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
												<input type="hidden" value="{{$pro->product_gia}}" class="cart_product_gia_{{$pro->product_id}}">
												<input type="hidden"  value="{{$pro->product_hinhanh}}" class="cart_product_hinhanh_{{$pro->product_id}}">
												<input type="hidden"  value="1" class="cart_product_qty_{{$pro->product_id}}">
								<span>
									<span>{{number_format($pro->product_gia).' '.'VND'}}</span>
									<label>Quantity:</label>
									<input name="qty" type="number" min="1" value="1" /><br>
									<input name="productid_hidden" type="hidden"  value="{{$pro->product_id}}" />
								
									<button type="button" class="btn btn-success add-to-cart" data-id_product="{{$pro->product_id}}" name="add-to-cart">Thêm giỏ hàng</button>

								</form>
								</span>
								<p><b>Tình trạng:</b> Còn hàng</p>
								<p><b>Hình Thức: </b>Mới</p>
								<p><b>Thương hiệu: </b>{{$pro->brand_name}}</p>
								<p><b>Danh mục: </b>{{$pro->category_name}}</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
		
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Mô Tả</a></li>
								<li ><a href="#companyprofile" data-toggle="tab">Chi Tiết</a></li>
					
							
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<p>{{$pro->product_mota}}</p>							
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<p>{{$pro->product_content}}</p>
							</div>

						
							
						</div>
					</div><!--/category-tab-->
					@endforeach	
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">SẢN PHẨM LIÊN QUAN</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
								@foreach($related as $key => $splq)	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{URL::to('public/uploads/product/'.$splq->product_hinhanh)}}" height="220px" width="100px" alt="" />
													<h2>{{number_format($splq->product_gia).'VND'}}</h2>
													<p>{{$splq->product_name}}</p>
													<button type="button" class="btn btn-success add-to-cart" data-id_product="{{$pro->product_id}}" name="add-to-cart">Thêm giỏ hàng</button>
												</div>
											</div>
										</div>
									</div>
								@endforeach
								</div>
								
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
@endsection
