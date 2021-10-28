<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<title>{{ config('app.name', 'Cafe') }}</title>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
	<!-- Google Fonts Roboto -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
	<!-- MDB -->
	<link rel="stylesheet" href="{{ asset('frontend/css/mdb.min.css') }}" />
	<!-- Custom styles -->
	<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />
	<style type="text/css">
		.navbar .nav-item a.active {
			color: #043a8c !important;
		}
		li.nav_login a:hover {
			color: #0C459E!important;
			background: #ffffff !important;
			border: 0.1px solid #0C459E !important;
		}
		nav ul.navbar-nav li a:hover {
			color: #043a8c !important;
		}
		nav ul.navbar-nav li.active a{
			color: #043a8c !important;
		}
		.fs-08 {
			font-size: 0.8em
		}
		.fs-09 {
			font-size: 0.9em
		}

		@media screen and (max-width: 576px) {

		}

		@media screen and (max-width: 768px) {
			.main_title {
				font-size: 2em !important;
			}
		}

		/*Large devices (desktops, 992px and up)*/
		@media screen and (max-width: 992px) { ... }

		/*X-Large devices (large desktops, 1200px and up)*/
		@media screen and (max-width: 1200px) { ... }

		/*XX-Large devices (larger desktops, 1400px and up)*/
		@media screen and (max-width: 1400px) { ... }

		#footer {
			background: #0b212d;
			padding: 0 0 30px 0;
			color: #fff;
			font-size: 14px;
		}

		#footer .footer-newsletter {
			padding: 50px 0;
			background: #0d2735;
		}

		#footer .footer-newsletter h4 {
			font-size: 24px;
			margin: 0 0 20px 0;
			padding: 0;
			line-height: 1;
			font-weight: 600;
			color: #a2cce3;
		}

		#footer .footer-newsletter form {
			margin-top: 30px;
			background: #fff;
			padding: 6px 10px;
			position: relative;
			border-radius: 50px;
		}

		#footer .footer-newsletter form input[type="email"] {
			border: 0;
			padding: 4px;
			width: calc(100% - 100px);
		}

		#footer .footer-newsletter form input[type="submit"] {
			position: absolute;
			top: 0;
			right: 0;
			bottom: 0;
			border: 0;
			background: none;
			font-size: 16px;
			padding: 0 20px;
			margin: 3px;
			background: #68A4C4;
			color: #fff;
			transition: 0.3s;
			border-radius: 50px;
		}

		#footer .footer-newsletter form input[type="submit"]:hover {
			background: #468db3;
		}

		#footer .footer-top {
			background: #0d2735;
			border-top: 1px solid #17455e;
			border-bottom: 1px solid #123649;
			padding: 60px 0 30px 0;
		}

		#footer .footer-top .footer-info {
			margin-bottom: 30px;
		}

		#footer .footer-top .footer-info h3 {
			font-size: 18px;
			margin: 0 0 20px 0;
			padding: 2px 0 2px 0;
			line-height: 1;
			color: #a2cce3;
			font-weight: 600;
		}

		#footer .footer-top .footer-info p {
			font-size: 14px;
			line-height: 24px;
			margin-bottom: 0;
			font-family: "Roboto", sans-serif;
			color: #fff;
		}

		#footer .footer-top .social-links a {
			font-size: 18px;
			display: inline-block;
			background: #f2e8e8;
			color: #fff;
			line-height: 1;
			padding: 8px 0;
			margin-right: 4px;
			border-radius: 50%;
			text-align: center;
			width: 36px;
			height: 36px;
			transition: 0.3s;
		}

		#footer .footer-top .social-links a:hover {
			background: #fff;
			color: #fff;
			text-decoration: none;
		}

		#footer .footer-top h4 {
			font-size: 18px;
			font-weight: 600;
			color: #a2cce3;
			position: relative;
			padding-bottom: 12px;
		}

		#footer .footer-top .footer-links {
			margin-bottom: 30px;
		}

		#footer .footer-top .footer-links ul {
			list-style: none;
			padding: 0;
			margin: 0;
		}

		#footer .footer-top .footer-links ul i {
			padding-right: 2px;
			color: #a2cce3;
			font-size: 18px;
			line-height: 1;
		}

		#footer .footer-top .footer-links ul li {
			padding: 10px 0;
			display: flex;
			align-items: center;
		}

		#footer .footer-top .footer-links ul li:first-child {
			padding-top: 0;
		}

		#footer .footer-top .footer-links ul a {
			color: #fff;
			transition: 0.3s;
			display: inline-block;
			line-height: 1;
		}

		#footer .footer-top .footer-links ul a:hover {
			color: #a2cce3;
		}

		#footer .footer-top .footer-contact {
			margin-bottom: 30px;
		}

		#footer .footer-top .footer-contact p {
			line-height: 26px;
		}

		#footer .copyright {
			text-align: center;
			padding-top: 30px;
		}

		#footer .credits {
			padding-top: 10px;
			text-align: center;
			font-size: 13px;
			color: #fff;
		}

		#footer .credits a {
			color: #a2cce3;
		}
	</style>
	@stack('styles')
</head>
<body>	
	<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
		<div class="container">
			<a class="navbar-brand me-2" href="{{ url('/') }}">
				<img src="{{ asset('frontend/img/logo_cafe.png') }}" width="50" alt="Logo Cafe" loading="lazy">
			</a>
			<button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fas fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarButtonsExample">
				<?php $active_menu = isset($active_menu) ? $active_menu : '' ?>
				<ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-bold">
					<li class="nav-item mx-3 {{ $active_menu == 'index' ? 'active' : '' }}">
						<a class="nav-link" href="{{ url('/') }}">Home</a>
					</li>
					<li class="nav-item mx-3 {{ $active_menu == 'facilities' ? 'active' : '' }}">
						<a class="nav-link" href="{{ url('/facilities') }}">Facilities</a>
					</li>
					<li class="nav-item mx-3 {{ $active_menu == 'bulletin' ? 'active' : '' }}">
						<a class="nav-link" href="{{ url('/bulletin') }}">Bulletin</a>
					</li>
					<li class="nav-item mx-3">
						@auth
						<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">Logout</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
						@endauth
					</li>
				</ul>
				<div class="">
					<img src="{{ asset('frontend/img/logo_triputra.png') }}" alt="Logo Triputra" loading="lazy">
				</div>
			</div>
		</div>
	</nav>
	<main>
		@yield('content')
	</main>
	<footer id="footer" class="mt-5">
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6 footer-links">
						<h4>Useful Links</h4>
						<ul>
							<li><i class="bx bx-chevron-right"></i> <a href="javascript:void(0);">Link</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="javascript:void(0);">About us</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="javascript:void(0);">Services</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="javascript:void(0);">Terms of service</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="javascript:void(0);">Privacy policy</a></li>
						</ul>
					</div>
					<div class="col-lg-3 col-md-6 footer-links">
						<h4>Our Services</h4>
						<ul>
							<li><i class="bx bx-chevron-right"></i> <a href="javascript:void(0);">Web Design</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="javascript:void(0);">Web Development</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="javascript:void(0);">Product Management</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="javascript:void(0);">Marketing</a></li>
							<li><i class="bx bx-chevron-right"></i> <a href="javascript:void(0);">Graphic Design</a></li>
						</ul>
					</div>
					<div class="col-lg-3 col-md-6 footer-contact">
						<h4>Contact Us</h4>
						<p>
							Jl. Gatot Subroto <br>
							Jakarta Barat, Jakarta<br>
							Indonesia <br><br>
							<strong>Phone:</strong> +1 5589 55488 55<br>
							<strong>Email:</strong> info@example.com<br>
						</p>
					</div>
					<div class="col-lg-3 col-md-6 footer-info">
						<h3>About Cafe</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
						<div class="social-links mt-3">
							<a href="javascript:void(0);"><img src="{{ asset('images/icons/twitter.svg') }}" width="20" alt="Twitter" /></a>
							<a href="javascript:void(0);"><img src="{{ asset('images/icons/facebook.svg') }}" width="20" alt="Facebook" /></a>
							<a href="javascript:void(0);"><img src="{{ asset('images/icons/instagram.svg') }}" width="20" alt="instagram" /></a>
							<a href="javascript:void(0);"><img src="{{ asset('images/icons/whatsapp.svg') }}" width="20" alt="whatsapp" /></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="copyright">
				© Copyright <strong><span>Cafe</span></strong>. All Rights Reserved
			</div>
		</div>
	</footer>
	<!-- jQuery 3 -->
	<script src="{{ asset('backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{ asset('backend/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/mdb.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/script.js') }}"></script>
	@stack('scripts')
</body>
</html>