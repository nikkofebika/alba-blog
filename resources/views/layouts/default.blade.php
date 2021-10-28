<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>blog</title>
	<meta content="" name="description">
	<meta content="" name="keywords">
	<link href="{{ asset('assets/img/logo/favicon.png') }}" rel="icon">
	<link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
	@stack('styles')
	<style type="text/css">
		.swiper {
			width: 100%;
			height: 100%;
		}

		.swiper-slide {
			text-align: center;
			font-size: 18px;
			background: #fff;
			display: -webkit-box;
			display: -ms-flexbox;
			display: -webkit-flex;
			display: flex;
			-webkit-box-pack: center;
			-ms-flex-pack: center;
			-webkit-justify-content: center;
			justify-content: center;
			-webkit-box-align: center;
			-ms-flex-align: center;
			-webkit-align-items: center;
			align-items: center;
		}

		.swiper-slide img {
			display: block;
			width: 100%;
			height: 100%;
			object-fit: cover;
		}
	</style>
</head>
<body>
	<header id="header" class="fixed-top d-flex align-items-center py-2">
		<div class="container d-flex align-items-center justify-content-between">
			<a class="" href="{{ url('') }}">
				<img src="{{ asset('assets/img/logo/logo_blog.png') }}">
			</a>
			<nav id="navbar" class="navbar float-end">
				<ul>
					@auth
					<li><a href="{{ url('') }}" @if($active_menu == 'home') class="active" @endif>Home</a></li>
					<li class="dropdown"><a href="#" @if($active_menu == 'bulletin') class="active" @endif><span>News/Event</span> <i class="bi bi-chevron-down"></i></a>
						<ul>
							<?php
							$ar_categories = cache()->get('ARTICLE_CATEGORIES', function () {
								return DB::table('categories')->select('id','title','seo_title')->whereNotNull('approved_by')->orderBy('priority', 'asc')->orderBy('updated_at', 'desc')->get();
							});
							foreach($ar_categories as $c) { ?>
								<li><a href="{{ url('bulletin/'.$c->seo_title) }}">{{ $c->title }}</a></li>
							<?php } ?>
						</ul>
					</li>
					<li><a href="{{ url('facilities') }}" @if($active_menu == 'facilities') class="active" @endif>Benefit & Facilities</a></li>
					<li><a href="{{ url('company-policy') }}" @if($active_menu == 'company-policy') class="active" @endif>Company Policy</a></li>
					@if(request()->route()->getPrefix() == '/dashboard')
					<li><a href="javascript:void(0)" class="getstarted" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
					@else
					<li class="dropdown"><a href="{{ url('dashboard') }}" class="justify-content-between"><img src="{{ asset(auth()->user()->photo) }}" class="rounded-circle" title="Dashboard" style="width: 35px !important; height: 35px !important;" /> <i class="bi bi-chevron-down d-lg-none ms-2"></i></a>
						<ul>
							<li><a href="{{ url('dashboard') }}">Dashboard</a></li>
							<li><a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
						</ul>
					</li>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
					@endif
					@else
					<li><a href="{{ url('') }}" @if($active_menu == 'home') class="active" @endif>Home</a></li>
					<li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#mdlLogin">News/Event</a></li>
					<li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#mdlLogin">Benefit & Facilities</a></li>
					<li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#mdlLogin">Company Policy</a></li>
					<li><a href="javascript:void(0)" class="getstarted" data-bs-toggle="modal" data-bs-target="#mdlLogin">Login</a></li>
					@endauth
					<li class="d-md-none"><a href="https://triputraenergi.com/id/" target="_blank" class="justify-content-center"><img src="{{ asset('assets/img/logo/logo-tem.png') }}"></a></li>
				</ul>
				<i class="bi bi-list mobile-nav-toggle"></i>
			</nav>
			<a class="d-lg-inline d-none" href="https://triputraenergi.com/id/" target="_blank">
				<img src="{{ asset('assets/img/logo/logo-tem.png') }}">
			</a>
		</div>
	</header>
	<main id="main">
		@yield('content')
	</main>
	<footer id="footer">
		<div class="footer-top pt-5">
			<div class="container">	
				<div class="row">
					<div class="col-12 text-center">
						<div class="" style="letter-spacing: 0.5px;">
							<a href="#" class="text-white fs-6 mx-3">Home</a>
							<a href="#" class="text-white fs-6 mx-3">About Us</a>
							<a href="#" class="text-white fs-6 mx-3">Services</a>
							<a href="#" class="text-white fs-6 mx-3">Terms of service</a>
							<a href="#" class="text-white fs-6 mx-3">Privacy policy</a>
						</div>
						<div class="social-links mt-3">
							<a title="Facebook" href="https://www.facebook.com/Triputra-Energi-Megatara-115382300260278/" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
							<a title="Instagram" href="https://www.instagram.com/triputraenergi/" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
							<a title="LinkedIn" href="https://www.linkedin.com/company/pt-triputra-energi-megatara" target="_blank" class="linkedin"><i class="bx bxl-linkedin"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="copyright">Copyright &copy; <strong><span>Triputra Energi</span></strong>. All Rights Reserved</div>
		</div>
	</footer>
	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
	@guest
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<div class="modal fade" id="mdlLogin" tabindex="-1" aria-labelledby="mdlLoginLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Login</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger fade show" role="alert" style="display: none;">
						Email / Kata sandi yang Anda masukkan salah!
					</div>
					<form id="form-login">
						<div class="form-group mb-2">
							<label>Email</label>
							<input name="email" type="email" class="form-control" placeholder="name@example.com">
						</div>
						<label>Password</label>
						<div class="input-group">
							<input name="password" id="inputPassword" type="password" class="form-control border-end-0" placeholder="Password">
							<span class="input-group-text border-start-0 bg-white" id="btnShowHide"><i id="iconShowHide" class="bx bx-show"></i></span>
						</div>
						<div class="checkbox my-2">
							<label>
								<input type="checkbox" value="remember-me"> Remember me
							</label>
						</div>
						<button class="w-100 btn btn-primary" type="submit" id="btn_submit">Login</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script src="{{ asset('backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
	<script type="text/javascript">
		const btnShowHide = document.getElementById('btnShowHide');
		const inputPassword = document.getElementById('inputPassword');
		let iconType = '';
		let inputType = '';
		btnShowHide.addEventListener('click', function (e) {
			if (inputPassword.getAttribute('type') === 'password') {
				inputType = 'text';
				iconType = 'bx bx-hide';
			} else {
				inputType = 'password';
				iconType = 'bx bx-show';
			}
			inputPassword.setAttribute('type', inputType);
			document.getElementById('iconShowHide').className = iconType;
		});
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		$('#form-login').on('submit', function(e){
			e.preventDefault();
			$('#btn_submit').attr('disabled',true).text('Loading...');
			$.post("{{ route('login') }}", $(this).serializeArray(), function(res){
				if (!res.success) {
					$('div.alert-danger').show();
					$('#btn_submit').attr('disabled',false).text('Login');
					setTimeout(function(){
						$('div.alert-danger').hide(500);
					}, 3000)
				} else {
					window.location.reload();
				}
			});
		});
	</script>
	@endguest
	<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
	<script src="{{ asset('assets/js/main.js') }}"></script>
	@stack('scripts')
</body>
</html>