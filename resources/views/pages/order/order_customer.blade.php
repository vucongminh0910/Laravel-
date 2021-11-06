@extends('layout')
@section('content')

			<div class="breadcrumbs">
				<h2 class="title text-center" style="color: #126E22;">Đơn hàng của bạn</h2>
			</div>

			<div class="table-responsive cart_info">
				
				<form action="" method="POST">
					{{csrf_field()}}
				<table class="table table-condensed">
					<thead>
						<tr class="menu" style="background: #126E22;">
							<td class="image" style="color:white;">STT </td>
							<td class="description" style="color:white;">Tên sản phẩm </td>
							<td class="price" style="color:white;">Giá</td>
							<td class="quantity" style="color:white;">Số lượng</td>
							<td class="total" style="color:white;">Thành tiền</td>
							<td class="time" style="color:white;">Ngày đặt hàng</td>
							<td class="tinhtrang" style="color:white;">Tình trạng đơn hàng</td>

							<td></td>
						</tr>
					</thead>
					<tbody>
						@php
						$i=0;
						@endphp
					@foreach($details as $key =>$donhang)
					@php
					$i++;
					@endphp
						<tr>
							<td class="">
								{{$i}}
							</td>
							<td class="cart_description">
								{{$donhang->product_name}}
							</td>
							<td class="cart_price">
								{{number_format($donhang->product_price).' '.'VND'}}
							</td>
							<td class="cart_quantity">
								{{$donhang->product_sales_quantity}}
							</td>
							<td class="cart_total">
								{{number_format(($donhang->product_price)*($donhang->product_sales_quantity)).' '.'VND'}}
							</td>
							<td class="cart_delete">
								{{$donhang->created_at}}
							</td>
							<td>
								@if($donhang->order_status==1)
									Đang chờ xác nhận
								@else
									Đơn hàng đã được xác nhận
								@endif		
							</td>
						</tr>
					
					@endforeach
					
					
						</tbody>
					
					</form>
				</table>
			</div>
		</div>
	</section>
							
					</div>
				</div>
			</div>
	

@endsection