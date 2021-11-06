<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>STREETWEAR</title>
        <link href="{{asset('public/fontend/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('public/fontend/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('public/fontend/css/prettyPhoto.css')}}" rel="stylesheet">
        <link href="{{asset('public/fontend/css/price-range.css')}}" rel="stylesheet">
        <link href="{{asset('public/fontend/css/animate.css')}}" rel="stylesheet">
        <link href="{{asset('public/fontend/css/main.css')}}" rel="stylesheet">
        <link href="{{asset('public/fontend/css/responsive.css')}}" rel="stylesheet">
        <link href="{{asset('public/fontend/css/sweetalert.css')}}" rel="stylesheet">
    
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->       
        <link rel="shortcut icon" href="public/fontend/img/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    </head>
    <!--/head-->
    <body>
        <header id="header">
            <!--header-->
            <div class="header_top">
                <!--header_top-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="contactinfo">
                                <ul class="nav nav-pills">
                                    <li><a href="#" class="header_top"><i class="fa fa-phone"></i> 0345535730</a></li>
                                    <li><a href="#" class="header_top"><i class="fa fa-envelope"></i> vn.outfit@gmail.com</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="social-icons pull-right">
                                <ul class="nav navbar-nav">
                                  
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/header_top-->
            <div class="header-middle">
                <!--header-middle-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="logo pull-left">
                                <a href="{{URL::to('/trang-chu')}}"><img src="{{asset('public/fontend/img/logo1.jpg')}}" class="logo" alt="" /><h2 class="logoimg">VN OUTFIT</h2></a>
                            </div>
                           
                        </div>
                        <div class="col-sm-8">
                            <div class="shop-menu pull-right">
                                <ul class="nav navbar-nav">
                                    <?php 
                                         $customers_id=Session::get('customers_id');
                                         if($customers_id!=NULL){
                                     ?>
                                    <li><a href="{{URL::to('/don-hang/'.$customers_id)}}"><i class="fa fa-user"></i>
                                        <?php
                                            $cus_name=Session::get('customers_name');
                                            if($cus_name){
                                            echo $cus_name;
                                        }
                                     ?></a></li>
                                    <?php 
                                    }else{
                                     ?>
                                     <?php 
                                     } ?>

                               
                                     <?php 
                                    $customers_id=Session::get('customers_id');
                                    $shipping_id=Session::get('shipping_id');
                                    if($customers_id!=NULL && $shipping_id==NULL){
                                    
                                    ?>
                                    <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-credit-card"></i> Thanh toán</a></li>
                                <?php }elseif($customers_id!=NULL && $shipping_id!=NULL){
                                 ?>
                                 
                                    <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-gear"></i>Thanh toán</a></li>
                                <?php } ?>
                                    
                                    <li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                                    <?php 
                                    $customers_id=Session::get('customers_id');
                                    if($customers_id!=NULL){
                                    
                                    ?>
                                    <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                                    
                                <?php }else{ ?>
                                    <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/header-middle-->
            <div class="header-bottom">
                <!--header-bottom-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="mainmenu pull-left">
                                <ul class="nav navbar-nav collapse navbar-collapse">
                                    <li><a href="{{URL::to('/trang-chu')}}" class="active" >Trang chủ</a></li>
                                   
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <form action="{{URL::to('/tim-kiem')}}" method="POST">
                                {{csrf_field()}}
                            <div class="search_box pull-right">
                                <input type="text" name="keywords_submit" placeholder="Nhập từ khóa tìm kiếm"/>
                                <input type="submit" style="margin-top:0;color:#666" name="search_item" class="btn btn-success btn-sm" value="Tìm kiếm">
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/header-bottom-->
        </header>
        <!--/header-->
        <section id="slider">
            <!--slider-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                  @php
                             $i=0;
                            @endphp
                                @foreach($all_banner as $key => $banner)
                                @php
                                $i++;
                                @endphp
                                <div class="item {{$i==1 ? 'active' : ''}}">
                                    <div class="col-sm-6">
                                        <h1><span>VN</span>-OUTFIT</h1>
                                        <h2>{{$banner->banner_name}}</h2>
                                    <p>{{$banner->banner_content}}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="{{URL::to('public/uploads/product/'.$banner->banner_img)}}" width="450px" height="300px" alt="" />  
                                    </div>
                                </div>
                            @endforeach
                            </div>
                            <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                            </a>
                            <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/slider-->
        <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2 style="color: #126E22;">Danh mục sản phẩm</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            @foreach($category as $key=>$cate)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></h4>
                                </div>
                            </div>
                            @endforeach
                        </div><!--/category-products-->
             

                        <div class="brands_products"><!--brands_products-->
                            <h2 style="color:#126E22">Thương hiệu sản phẩm</h2>
                            @foreach($brand as $key => $brand )
                            <div class="brands-name">
                                        <ul class="nav nav-pills nav-stacked">
                                            <li>
                                                <a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}"> <span class="pull-right"></span>{{$brand->brand_name}}</a>
                                            </li>
                                        </ul>
                             </div>
                                    @endforeach

                        </div><!--/brands_products-->
                        
                             
                    
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">
                    @yield('content')
                    
                </div>
            </div>
        </div>
    </section>
        <footer id="footer">
            <!--Footer-->
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="companyinfo">
                                <h2><span>VN</span>-OUTFIT</h2>
                                <p>LOCAL BRAND VIETNAM</p>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="col-sm-2">
                                <div class="video-gallery text-center">
                                    
                                        <div class="iframe-img">
                                            <img src="{{asset('public/fontend/img/logbad.png')}}" class="imgfooter" alt="" />
                                        </div>
                                        <div class="overlay-icon">
                                            <i class="fa fa-play-circle-o"></i>
                                        </div>
                                  
                                    <p>DOUBLE HABBIT</p>
                                  
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="video-gallery text-center">
                                    
                                        <div class="iframe-img">
                                            <img src="{{asset('public/fontend/img/logo5way.png')}}"  class="imgfooter"  alt="" />
                                        </div>
                                        <div class="overlay-icon">
                                            <i class="fa fa-play-circle-o"></i>
                                        </div>
                                  
                                    <p>5 THEWAY</p>
                                    
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="video-gallery text-center">
                                    
                                        <div class="iframe-img">
                                            <img src="{{asset('public/fontend/img/logodirty.png')}}"  class="imgfooter" alt="" />
                                        </div>
                                        <div class="overlay-icon">
                                            <i class="fa fa-play-circle-o"></i>
                                        </div>
                                    
                                    <p>DIRTY COINS</p>
                                   
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="video-gallery text-center">
                                    
                                        <div class="iframe-img"> 
                                            <img src="{{asset('public/fontend/img/logoimb.png')}}"  class="imgfooter" alt="" />
                                        </div>
                                        <div class="overlay-icon">
                                            <i class="fa fa-play-circle-o"></i>
                                        </div>
                                    
                                    <p>IMA GOD BREAKER</p>
                                  
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="video-gallery text-center">
                                  
                                        <div class="iframe-img">
                                            <img src="{{asset('public/fontend/img/logoswe.pn')}}g"  class="imgfooter" alt="" />
                                        </div>
                                        <div class="overlay-icon">
                                            <i class="fa fa-play-circle-o"></i>
                                        </div>
                                    
                                    <p>SWE</p>
                                    
                                </div>
                            </div>
                             <div class="col-sm-2">
                                <div class="video-gallery text-center">
                                    
                                        <div class="iframe-img">
                                            <img src="{{asset('public/fontend/img/logohades.png')}}"  class="imgfooter" alt="" />
                                        </div>
                                        <div class="overlay-icon">
                                            <i class="fa fa-play-circle-o"></i>
                                        </div>
                                   
                                    <p>HADES</p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-widget">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="single-widget">
                                <h2 class="fotter">Địa chỉ cửa hàng</h2>
                                <ul class="nav nav-pills nav-stacked">
                                    <li class="fotter"><i class="fa fa-home"></i> 35 CAO LỖ,P4,Q8,TP.HCM,VIỆT NAM</li>
                                   <!--  <li><i class="fa fa-home"></i> 35 CAO LỖ,P4,Q8,TP.HCM,VIỆT NAM</li>
                                    <li><i class="fa fa-home"></i> 35 CAO LỖ,P4,Q8,TP.HCM,VIỆT NAM</li>
                                    <li><i class="fa fa-home"></i> 35 CAO LỖ,P4,Q8,TP.HCM,VIỆT NAM</li>     -->     
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="footer-bottom">

            </div>
        </footer>
        <!--/Footer-->
        <script src="{{asset('public/fontend/js/jquery.js')}}"></script>
        <script src="{{asset('public/fontend/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('public/fontend/js/jquery.scrollUp.min.js')}}"></script>
        <script src="{{asset('public/fontend/js/price-range.js')}}"></script>
        <script src="{{asset('public/fontend/js/jquery.prettyPhoto.js')}}"></script>
        <script src="{{asset('public/fontend/js/main.js')}}"></script>
        <script src="{{asset('public/fontend/js/sweetalert.js')}}"></script>

        <script src="{{asset('public/fontend/js/jquery.validate.min.js')}}"></script>
        <script type="text/javascript">
                  $(document).ready(function(){
                     $('.send-order-ajax').click(function(){
             
                        var shipping_email= $('.shipping_email').val();
                        var shipping_name= $('.shipping_name').val();
                        var shipping_address= $('.shipping_address').val();
                        var shipping_phone= $('.shipping_phone').val();
                        var shipping_note= $('.shipping_note').val();
                        var shipping_method= $('.shipping_method').val();
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url:'{{url('/insert-shipping')}}',
                            method:'POST',
                            data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_note:shipping_note,shipping_method:shipping_method,_token:_token},
                            success:function(){
                             swal("Cảm ơn", "Đơn hàng của bạn dã được xác nhận", "success")
                            }
                         
                            });
                          window.setTimeout(function(){
                                location.reload();
                            },1500);
                         
                        });
                    });
                    
            </script>

  
        <script type="text/javascript">
            $(document).ready(function(){
             $('.add-to-cart').click(function(){
                var id=$(this).data('id_product');
                var cart_product_id= $('.cart_product_id_' + id).val();
                var cart_product_name= $('.cart_product_name_' + id).val();
                var cart_product_gia= $('.cart_product_gia_' + id).val();
                var cart_product_hinhanh= $('.cart_product_hinhanh_' + id).val();
                var cart_product_qty= $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/add-cart-ajax')}}',
                    method:'POST',
                    data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_gia:cart_product_gia,cart_product_hinhanh:cart_product_hinhanh,cart_product_qty:cart_product_qty,_token:_token},
                    success:function(){
                        swal({
                            title:"Đã thêm sản phẩm vào giỏ hàng",
                            text:"Bạn có thể xem sản phẩm tiếp hoặc tới trang thanh toán",
                            showCancelButton:true,
                            CancelButtonText:"Xem tiếp",
                            confirmButtonClass:"btn-success",
                            confirmlButtonText:"Đi đến giỏ hàng",
                            closeOnConfirm: false
                        },
                        function(){
                            window.location.href = "{{url('/gio-hang')}}";
                  
                        });
                    }
                    });
                });
            });
            
          
        
        </script>
        
       <script type="text/javascript">
        $("#formlogin").validate({
                rules: {
                    email_acc:{
                         required: true,
                         email: true
                    },
                    pass_acc:{
                        required: true,


                    }
                
            
                },
                messages: {
                    email_acc:{
                         required:"Email không được để trống",
                         email:"Email nhập chưa đúng định dạng"
                    },
                    pass_acc:{
                        required:"Mật khẩu không được để trống"
                     
                    }
        

                },
                submitHandler: function(form) {
                
                 $("#formlogin").submit();
                }
            });
    </script>
    <script type="text/javascript">
        $("#formdk").validate({
                rules: {
                    customers_name:{
                         required: true,
                         minlength:5
                    },
                    customers_email:{
                         required: true,
                         email: true
                    },
                    customers_password:{
                        required:true

                    },
                    customers_phone:{
                        required:true,
                        digits: true,

                    }
                
            
                },
                messages: {
                    customers_name:{
                         required:"Tên không được để trống",
                         minlength:"Tối thiểu 5 kí tự"
                    },
                    customers_email:{
                        required:"Email không được để trống",
                         email:"Email nhập chưa đúng định dạng"
                    },
                     customers_password:{
                        required:"Bạn chưa điền mật khẩu"

                    },
                    customers_phone:{
                    required:"Bạn chưa nhập số điện thoại",
                    digits:"Định dạng chưa đúng"
                    }

        

                },
                submitHandler: function(form) {
                
                 $("#formdk").submit();
                }
            });
    </script>
    <script type="text/javascript">
        $("#formdonhang").validate({
            rules: {
                shipping_email:{
                    required: true,
                    email: true
                },
                shipping_name:{
                    required: true,
                    minlength:5
                },
                shipping_address:{
                    required: true,
                    minlength:10
                },
                shipping_phone:{
                    required:true,
                    digits: true,
                },
                shipping_note:{
                    minlength:0
                }
            },
            messages: {
                shipping_email:{
                    required:"Email không được để trống",
                    email:"Email nhập chưa đúng định dạng"
                },
                shipping_name:{
                    required:"Tên không được để trống",
                    minlength:"Tối thiểu 5 kí tự"
                },
                shipping_address:{
                    required:"Địa chỉ không được để trống",
                    minlength:"Tối thiểu 10 kí tự"
                },
                shipping_phone:{
                    required:"Bạn chưa nhập số điện thoại",
                    digits:"Định dạng chưa đúng"
                },
                shipping_note:{
                    
                }
            },
            submitHandler:function(form){
                $("#formdonhang").submit();
            }
        });
    </script>
    
    </body>
</html>