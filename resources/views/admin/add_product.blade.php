@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
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
                                <form role="form" id="formaddpro" action="{{URL::to('/save-product')}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label>Tên sản phẩm</label><br>
                                    <input type="text"  name="product_name" class="form-control"  placeholder="Tên sản phẩm"><br>
                                </div>
                                   <div class="form-group">
                                    <label>Giá sản phẩm</label><br>
                                    <input type="text"  name="product_gia" class="form-control" placeholder="Giá sản phẩm"><br>
                                </div>
                                <div class="form-group">
                                    <label>Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_hinhanh" class="form-control"  >
                                </div>
                                <div class="form-group">
                                    <label>Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="product_mota" id="ckeditor1" placeholder="Mô tả sản phẩm">
                                
                                    </textarea>  
                                </div>
                                <div class="form-group">
                                    <label>Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="product_content" 
                                    id="ck2" placeholder="Nội dung sản phẩm">
                                
                                    </textarea>  
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Danh mục sản phẩm</label>
                                    <select name="cate_product" class="form-control input-sm m-bot15">
                                    @foreach($cate_product as $key => $cate)
                                        <option value="{{$cate->category_id}}">{{$cate->category_name}} </option>
                                    @endforeach
                                     
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Thương hiệu</label>
                                    <select name="brand_product" class="form-control input-sm m-bot15">
                                    @foreach($brand_product as $key => $brand)
                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
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
                               
                                <button type="submit" name="add_product" class="btn btn-info">Thêm </button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
            @endsection