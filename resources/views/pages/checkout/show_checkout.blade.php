    @extends('layout')
@section('content')
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active">Trang gửi hàng</li>
            </ol>
        </div>
        <!--/breadcrums-->
        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <p >
                        <h2 style="color:#126E22">Thông tin gửi hàng</h2>
                        </p>
                    </div>
                    <br>
                    <div class="form-one">
                        <form  id="formdonhang" method="POST">
                            {{csrf_field()}}
                            <input type="text" name="shipping_email" class="shipping_email" placeholder="Email*">
                            <input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên">
                            <input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ">
                            <input type="text" name="shipping_phone" class="shipping_phone" placeholder="Phone">
                            <textarea  name="shipping_note" class="shipping_note"  placeholder="Ghi chú đơn hàng của bạn" rows="9"></textarea><br>
                           <div class="">
                            <div class="form-group">
                               <label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
                                <select name="shipping_method" class="form-control input-sm m-bot15 shipping_method">
                              
                                    <option value="0">Thanh toán online</option>
                                    <option value="1">Thanh toán sau khi nhận hàng</option>       
                              </select>
                               </div>
                           </div>
                            <input type="button" value="Xác nhận đơn hàng" name="send-order-ajax" class="btn btn-primary btn-sm send-order-ajax">
                        </form>

                    </div>
                    
                </div>
            <div class="col-sm-12 clearfix">
                <div class="table-responsive cart_info">
                    <form action="{{url('/update-cart')}}" method="POST">
                        {{csrf_field()}}
                        <table class="table table-condensed">
                            <thead>
                                <tr class="menu" style="background: #126E22;">
                                    <td class="image" style="color:white;">Hình ảnh </td>
                                    <td class="description" style="color:white;">Tên sản phẩm </td>
                                    <td class="price" style="color:white;">Giá</td>
                                    <td class="quantity" style="color:white;">Số lượng</td>
                                    <td class="total" style="color:white;">Thành tiền</td>
                                    <td style="color:white;">Xóa</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if(Session::get('cart')==true)
                                @php
                                $total = 0;
                                @endphp
                                @foreach(Session::get('cart') as $key =>$cart)
                                @php
                                $subtotal = $cart['product_qty'] * $cart['product_gia']; 
                                $total+=$subtotal;
                                @endphp
                                <tr>
                                    <td class="cart_product">
                                        <img src="{{asset('public/uploads/product/'.$cart['product_hinhanh'])}}" width="50px" alt="{{$cart['product_name']}}"></a>
                                    </td>
                                    <td class="cart_description">
                                        <h4><a href=""></a></h4>
                                        <p>{{$cart['product_name']}}</p>
                                    </td>
                                    <td class="cart_price">
                                        <p>{{number_format($cart['product_gia']).' '.'VND'}}</p>
                                    </td>
                                    <td class="cart_quantity">
                                       
                                            <input style="text-align:center;" class="cart_quantity" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" >
                                       
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">
                                            {{number_format($subtotal).' '.'VND'}}
                                        </p>
                                    </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete" href="{{url('/delete-product-cart/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                  
                                    <td>
                                        <div class="total_area"  >
                                            <ul>
                                             <li>Tổng đơn hàng <span><center> {{number_format($total).' '.'VND'}}</center></span></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @else
                                    <tr>
                                        <td colspan="5"><center>
                                                @php
                                                    echo 'Chưa có sản phẩm trong giỏ hàng';
                                                @endphp
                                                </center>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </form>
                    </table>
                </div>

<!--/#cart_items-->

@endsection