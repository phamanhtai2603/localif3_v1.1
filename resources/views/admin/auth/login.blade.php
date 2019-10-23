<!DOCTYPE html>
<html lang="">
<head>
	<title>Đăng nhập</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<base href="{{ asset('') }}">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="/admin_page_asset/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/admin_page_asset/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/admin_page_asset/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/admin_page_asset/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/admin_page_asset/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/admin_page_asset/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/admin_page_asset/css/util.css">
	<link rel="stylesheet" type="text/css" href="/admin_page_asset/css/main.css">
<!--===============================================================================================-->
<style>
    .box-beauty{
    box-shadow: 1px 2px 2px 5px rgba(128, 128, 128, 0.6);
    border-radius: 5px;
    padding: 15px;
}
</style>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="/admin_page_asset/images/img-01.png" alt="IMG">
				</div>

            <form class="login100-form validate-form box-beauty" action="{{route('post-admin-login')}}" method="POST">
                @csrf
                    <span class="login100-form-title">
						Đăng nhập
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Không được để trống">
						<input class="input100" type="text" name="username" placeholder="Tên tài khoản">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                    </div>
                    @if($errors->has('username'))
                        <p class="text-danger">
                            {{$errors->first('username')}}
                        </p>
                    @endif

					<div class="wrap-input100 validate-input" data-validate = "Không được để trống">
						<input class="input100" type="password" name="password" placeholder="Mật khẩu">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                    </div>
                    @if($errors->has('password'))
                        <p class="text-danger">
                            {{$errors->first('password')}}
                        </p>
                    @endif
                    @if (session('msg'))
                    <p class="text-danger mt-1">{{session('msg')}}
                        </p>
                    @endif
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Đăng nhập
						</button>
					</div>

					{{-- <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div> --}}

					{{-- <div class="text-center p-t-136">
						<a class="txt2" href="#">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div> --}}
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="/admin_page_asset/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/admin_page_asset/vendor/bootstrap/js/popper.js"></script>
	<script src="/admin_page_asset/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/admin_page_asset/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/admin_page_asset/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="/admin_page_asset/js/mainAdmin.js"></script>

</body>
</html>