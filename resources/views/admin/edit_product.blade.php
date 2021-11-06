@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật sản phẩm 
                        </header>
                        <div class="panel-body">
                            <?php 
                            $messages=Session::get('messages');
                            if($messages){
                                echo '<span class="text-alert">'.$messages.'</span>';
                                Session::put('messages',NULL);
                            }
                             ?>
                            <div class="position-center">
                                @foreach($edit_product as $key => $pro)
                                <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" value="{{$pro->product_name}}" name="product_name" class="form-control" id="exampleInputEmail1" 
                                </div>
                                   <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" value="{{$pro->product_gia}}" name="product_gia" class="form-control" id="exampleInputEmail1"
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_hinhanh" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/uploads/product/'.$pro->product_hinhanh)}}" height="100px" width="100px">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="8"  class="form-control" name="product_mota" id="exampleInputPassword1" >
                                    {{$pro->product_mota}}
                                    </textarea>  
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="product_content" id="exampleInputPassword1" placeholder="Nội dung sản phẩmc">
                                {{$pro->product_content}}
                                    </textarea>  
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Danh mục sản phẩm</label>
                                    <select name="cate_product" class="form-control input-sm m-bot15">
                                    @foreach($cate_product as $key => $cate)
                                    @if($cate->category_id==$pro->category_id)
                                        <option selected value="{{$cate->category_id}}">{{$cate->category_name}} </option>
                                    @else
                                        <option value="{{$cate->category_id}}">{{$cate->category_name}} </option>
                                    @endif
                                    @endforeach
                                     
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Thương hiệu</label>
                                    <select name="brand_product" class="form-control input-sm m-bot15">
                                    @foreach($brand_product as $key => $brand)
                                     @if($brand->brand_id==$pro->brand_id)
                                        <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                         @else
                                          <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                          @endif
                                    @endforeach
                                     
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Hiển thị</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                     
                                    </select>
                                </div>
                               
                                <button type="submit" name="update_product" class="btn btn-info">Cập nhật</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>
            @endsection