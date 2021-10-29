<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="{{ asset('backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/bower_components/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/bower_components/Ionicons/css/ionicons.min.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/dist/css/AdminLTE.min.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/plugins/iCheck/square/blue.css') }}">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="/"><b>blog</b></a>
		</div>
		<div class="login-box-body">
			<p class="login-box-msg">Sign in to start your session</p>
			@if (session('error'))
			<div class="alert alert-danger alert-dismissible alert_flash">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-ban"></i> Error!</h4>
				{{ session('error') }}
			</div>
			@endif
			<form action="{{ route('login') }}" method="POST">
				@csrf
				<div class="form-group has-feedback">
					<input name="email" type="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div>
				<div class="form-group">
					<div class="input-group">
						<input name="password" type="password" id="password" required class="form-control" placeholder="Password">
						<span class="input-group-addon" id="btnShowHide"><i class="fa fa-eye"></i></span>
						<span class="input-group-append"></span>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-8">
						<div class="checkbox icheck">
							<label>
								<input name="remember" type="checkbox"> Remember Me
							</label>
						</div>
					</div>
					<div class="col-xs-4">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script src="{{ asset('backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('backend/plugins/iCheck/icheck.min.js') }}"></script>
	<script>
		$(function () {
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%'
			});
			x = document.getElementById("password");
			$('#btnShowHide').click(function(){
				if (x.type === "password") {
					$(this).children().removeClass('fa-eye').addClass('fa-eye-slash');
					x.type = "text";
				} else {
					x.type = "password";
					$(this).children().removeClass('fa-eye-slash').addClass('fa-eye');
				}
			});
		});
	</script>
</body>
</html>
