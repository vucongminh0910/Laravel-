@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật thương hiệu sản phẩm
                        </header>
                         <?php 
                            $messages=Session::get('messages');
                            if($messages){
                                echo '<span class="text-alert">'.$messages.'</span>';
                                Session::put('messages',NULL);
                            }
                             ?>
                        <div class="panel-body">
                            @foreach($edit_brand_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-brand-product/'.$edit_value->brand_id)}}" method="POST">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" value="{{$edit_value->brand_name}}" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style="resize: none" rows="8" class="form-control"  name="brand_product_mota" id="exampleInputPassword1">{{$edit_value->brand_mota}}
                                    </textarea>  
                                </div>
                                @endforeach
                              
                               
                                <button type="submit" name="update_brand_product" class="btn btn-info">Cập nhật thương hiệu</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
            @endsection