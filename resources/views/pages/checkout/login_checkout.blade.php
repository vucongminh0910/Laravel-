@extends('layout')
@section('content')
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="register-req">
				<p>Làm ơn đăng ký hoặc đăng nhập để thanh toán và xem lịch sử mua hàng </p>
			</div><!--/register-req-->
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập tài khoản</h2>
						<?php 
						$messages=Session::get('messages');
						if($messages){
							echo '<span class="text-alert messages" >'.$messages.'</span>';
							Session::put('messages',NULL);
						}
						 ?>
						<form action="{{URL::to('login-customer')}}" id="formlogin" method="POST">
							{{csrf_field()}}
							<input type="text" name="email_acc" placeholder="Tên" />
							<input type="password" name="pass_acc" placeholder="Mật khẩu" />
						
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Tạo tài khoản mới</h2>
						<form action="{{URL::to('/add-customer')}}" id="formdk" method="POST">
							{{csrf_field()}}
							<input type="text" name="customers_name" placeholder="Tên tài khoản"/>
							<input type="email" name="customers_email" placeholder="Địa chỉ email"/>
							<input type="password" name="customers_password" placeholder="Mật khẩu"/>
							<input type="text" name="customers_phone" placeholder="Số điện thoai"/>
							<button type="submit" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection