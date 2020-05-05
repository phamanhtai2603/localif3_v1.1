<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
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
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form action="{{ route('post-page-registration-store') }}" method="POST" class=" login100-form validate-form">
				@csrf
					<span class="login100-form-title p-b-43" style="color:	#E96E50;">
						Register
					</span>
					@if (session('noti'))
					<div class="alert alert-danger">{{ session('noti') }}</div>
					@endif
					@if (session('success'))
						<div class="alert alert-success">{{ session('success') }}</div>
					@endif
					
					<div class="borderout">
						<div class="borderradio radioleft Unselected" id="boder-custommer">
							<input id="custommer" class="inline" type="radio" name="role" value="3" checked> 
							<label for="custommer" class="inline">I am a traveller</label>
						</div>
						<div class="borderradio radioright" id="boder-make-tour">
							<input id="make-tour" class="inline" type="radio" name="role" value="2">
							<label for="make-tour" class="inline">I am tour guide</label>
						</div>
					</div>
					<br>

					<div class="wrap-input100 validate-input" data-validate = "Enter your real name">
						<input class="input100" type="text" name="first_name">
						<span class="focus-input100"></span>
						<span class="label-input100">First Name</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="last_name">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Last Name</span>
                    </div>

					<div class="wrap-input100 validate-input" data-validate = "Your phone number is..">
						<input class="input100" type="text" name="phone_number">
						<span class="focus-input100"></span>
						<span class="label-input100">Phone number</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="email">
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="background-color: 	#E96E50">
							Done
						</button>
					</div>
					
					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							or <a href="{{ route('get-login') }}" class="txt1">Login</a>
						</span>
					</div>
				</form>

			<div class="login100-more" style="background-image: url('page_login/images/bg-01.jpg');">
				</div>
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