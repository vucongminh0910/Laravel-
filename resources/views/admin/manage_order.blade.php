@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
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
            <th>Mã đơn hàng</th>
            <th>Tình trạng</th>
            <th>Ngày đặt hàng</th>
            <th>Xem chi tiết đơn hàng</th>
            <th>Xác nhận đơn hàng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @php
        $i=0;
        @endphp
          @foreach($order as $key => $od)
          @php
            $i++;
          @endphp

          <tr>
            <td><i>{{$i}}</i></td>
            <td>{{$od->order_code}}</td>
           
            <td>
              @if($od->order_status==1)
                Đơn hàng mới
              @else
                Đã xử lí
              @endif
            </td>
              
            <td>{{$od->created_at}}</td>

            <td>
              <a href="{{URL::to('/view-order/'.$od->order_code)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-eye text-success text-active"></i>
              </a>

            </td>
            <td>
              <?php 
              if($od->order_status==1){
               ?>
              
               <a href="{{URL::to('/xacnhan-order/'.$od->order_code)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-check-square text-danger text"></i>
              </a>
              <?php
              }else{
              ?>
              
                <a href="{{URL::to('/huy-order/'.$od->order_code)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-check-square-o text-danger text"></i>
              </a>
              <<?php } ?>
            </td>
          </tr>
         @endforeach
        
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection