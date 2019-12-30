<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <base href="{{asset('')}}">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="page_login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="page_login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="page_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="page_login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="page_login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="page_login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="page_login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="page_login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="page_login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="page_login/css/util.css">
	<link rel="stylesheet" type="text/css" href="page_login/css/main.css">
	<link rel="stylesheet" type="text/css" href="page_login/css/custom.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="{{route('post-login')}}" method="POST">
					@csrf
					<div ><a href="{{ route('get-page-view') }}" ><img class="user-avatar rounded-circle float-center" width="80px"  src="upload/images/logo.jpg" alt="User Avatar"></a></div>	
					<span class="login100-form-title p-b-43" style="color:	#E96E50;">
						Login to continue
					</span>
					@if (session('noti'))
						<div class="alert alert-danger">{{ session('noti') }}</div>
					@endif
					@if (session('success'))
						<div class="alert alert-success">{{ session('success') }}</div>
					@endif
					
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email">
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>
			

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn" style="background-color: 	#E96E50">
							Login
						</button>
					</div>
					
					<div class="text-center p-t-46 p-b-20">
						<span class="txt2"><a href="{{ route('get-page-registration-view') }}">
							or sign up here!
							</a>
						</span>
					</div>
				</form>
				<div class="login100-more"  style="background-image: url('page_login/images/bg-01.jpg');">
				</a>
			</div>
		</div>
	</div>

<!--===============================================================================================-->
	<script src="page_login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="page_login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="page_login/vendor/bootstrap/js/popper.js"></script>
	<script src="page_login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="page_login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="page_login/vendor/daterangepicker/moment.min.js"></script>
	<script src="page_login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="page_login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="page_login/js/main.js"></script>

</body>
</html>