@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê banner
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
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên banner</th>
            <th>Hình ảnh</th>
            <th>Content</th>
            <th>Hiển thị</th>
            <th>Chức năng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach( $all_banner as $key => $banner)

          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$banner->banner_name}}</td>
            <td><img src="public/uploads/product/{{$banner->banner_img}}" height="100px" width="100px"></td>
            <td>{{$banner->banner_content}}</td>   
            <td><span class="text-ellipsis">
              <?php 
              if($banner->banner_status==0){
                ?>
                <a href="{{URL::to('/active-banner/'.$banner->banner_id)}}" > <span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php 
                }else{
                 ?>
                <a  href="{{URL::to('/unactive-banner/'.$banner->banner_id)}}"  > <span class="fa-thumb-styling fa fa-thumbs-up"></span></a> 
              <?php } ?>
            </span></td>

            <td>
    
              <a href="{{URL::to('/delete-banner/'.$banner->banner_id)}}" onclick="return confirm('Bạn có chắc xóa banner này không?')" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
         @endforeach
        
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
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
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection