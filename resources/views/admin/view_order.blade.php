@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin khách hàng 
    </div>
   
    <div class="table-responsive">
       <?php 
           $messages=Session::get('messages');
           if($messages){
            echo '<span class="text-alert">'.$messages.'</span>';
           Session::put('messages',NULL);
             }
            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Email</th>
  

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        
          <tr>
           
            <td>{{$customer->customers_name}}</td>
            <td>{{$customer->customers_phone}}</td>
            <td>{{$customer->customers_email}}</td>

           
          </tr>
         
        
        </tbody>
      </table>
    </div>
   
  </div>
</div>
<br><br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin vận chuyển
    </div>
   
    <div class="table-responsive">
       <?php 
           $messages=Session::get('messages');
           if($messages){
            echo '<span class="text-alert">'.$messages.'</span>';
           Session::put('messages',NULL);
             }
            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            
            <th>Tên người nhận</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Ghi chú</th>
            <th>Hình thức thanh toán</th>
  

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        
          <tr>
           
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_phone}}</td>
            <td>{{$shipping->shipping_address}}</td>
            <td>{{$shipping->shipping_note}}</td>
            <td>@if($shipping->shipping_method==0)
                Thanh toán online
                @else
                Thanh toán sau khi nhận hàng
                @endif
            </td>
           
          </tr>
         
        
        </tbody>
      </table>
    </div>
   
  </div>
</div>
<br><br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Chi tiết đơn hàng
    </div>
    <div class="row w3-res-tb">
       <?php 
           $messages=Session::get('messages');
           if($messages){
            echo '<span class="text-alert">'.$messages.'</span>';
           Session::put('messages',NULL);
             }
            ?>

    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá </th>
            <th>Tổng tiền</th>
            

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
          $i=0;
          $total=0;
          @endphp
        @foreach($details as  $key =>$valu)
        @php
        $i++;
        $subtotal=($valu->product_sales_quantity)*($valu->product_price);
        $total+=$subtotal;
        @endphp
          <tr>
            <td>{{$i}}</td>
            <td>{{$valu->product_name}}</td>
            <td>{{$valu->product_sales_quantity}}</td>
            <td>{{number_format($valu->product_price).' '.'VND'}}</td>
            <td>{{number_format($subtotal).' '.'VND'}}</td>
           
          </tr>
         
        @endforeach
        <tr>
          <td>Tổng Thanh toán: {{number_format($total).' '.'VND'}}</td>
        </tr>
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
      <!--   <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div> -->
      </div>
    </footer>
  </div>
</div>
@endsection