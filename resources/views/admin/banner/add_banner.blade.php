@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm banner
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
                                <form role="form" id="formaddpro" action="{{URL::to('/save-banner')}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label>Tên banner</label><br>
                                    <input type="text"  name="banner_name" class="form-control"  placeholder="Tên Banner"><br>
                                <div class="form-group">
                                    <label>Hình ảnh banner</label>
                                    <input type="file" name="banner_hinhanh" class="form-control"  >
                                </div>
                                <div class="form-group">
                                    <label>Nội dung banner</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="banner_content" id="ckeditorbanner" placeholder="Nội dung của banner"></textarea>  
                                
                             
                                </div>
                              
                                <div class="form-group">
                                    <label for="exampleInputFile">Hiển thị</label>
                                    <select name="banner_status" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                     
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_banner" class="btn btn-info">Thêm </button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
            @endsection