<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>{{ env('APP_NAME', 'Blog') }}</title>
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
</head>
<body>
	<header id="header" class="fixed-top d-flex align-items-center">
		<div class="container d-flex align-items-center">
			<h1 class="logo me-auto"><a href="/">{{ env('APP_NAME', 'Blog') }}</a></h1>
			<nav id="navbar" class="navbar">
				<ul>
					@auth
					<li><a href="{{ url('console/dashboard') }}" target="_blank">Dashboard</a></li>
					<li><a href="javascript:void" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
						@csrf
					</form>
					@else
					<li><a href="{{ url('login') }}" target="_blank">Login</a></li>
					@endauth
				</ul>
				<i class="bi bi-list mobile-nav-toggle"></i>
			</nav>
		</div>
	</header>
	<main id="main">
		<section id="blog" class="blog" style="margin-top: 80px;">
			<div class="container" data-aos="fade-up">
				<div class="row">
					<div class="col-lg-8 entries">
						@yield('content')
					</div>
					<div class="col-lg-4">
						<div class="sidebar">
							<h3 class="sidebar-title">Search</h3>
							<div class="sidebar-item search-form">
								<form action="" method="get">
									<input type="text" id="query" name="q" value="<?php echo isset($_GET['q']) && $_GET['q'] != '' ? $_GET['q'] : '' ?>" style="outline: none;">
									<button type="submit"><i class="bi bi-search"></i></button>
								</form>
							</div>
							<h3 class="sidebar-title">Categories</h3>
							<div class="sidebar-item categories">
								<ul>
									<li><a href="/" class="@if($category_id == 0) fw-bold text-primary @endif">- All</a></li>
									@foreach($categories as $c)
									<li><a href="{{ url($c->seo_title) }}" class="@if($category_id == $c->id) fw-bold text-primary @endif">- {{ $c->title }}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	<footer id="footer">
		<div class="container">
			<div class="copyright">Copyright &copy; <strong><span>Nikko Febika</span></strong></div>
		</div>
	</footer>
	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
	<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
	<script src="{{ asset('assets/js/main.js') }}"></script>
	@stack('scripts')
</body>
</html>