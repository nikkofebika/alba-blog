<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TechNews - HTML and CSS Template</title>
	<link href="assets/img/favicon.png" rel=icon>
	<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,500' rel='stylesheet' type='text/css'>
	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/fonts/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/mobile-menu.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/owl.carousel.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/owl.theme.default.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
	@stack('styles')
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar">
	<div id="main-wrapper">
		<div id="preloader">
			<div id="status">
				<div class="status-mes"></div>
			</div>
		</div>
		<div class="uc-mobile-menu-pusher">
			<div class="content-wrapper">
				<section id="header_section_wrapper" class="header_section_wrapper">
					<div class="container">
						<div class="header-section">
							<div class="row">
								<div class="col-md-4">
									<div class="left_section">
										<span class="date">
											Sunday .
										</span>
										<span class="time">
											09 August . 2016
										</span>
										<div class="social">
											<a class="icons-sm fb-ic"><i class="fa fa-facebook"></i></a>
											<a class="icons-sm tw-ic"><i class="fa fa-twitter"></i></a>
											<a class="icons-sm inst-ic"><i class="fa fa-instagram"> </i></a>
											<a class="icons-sm tmb-ic"><i class="fa fa-tumblr"> </i></a>
											<a class="icons-sm rss-ic"><i class="fa fa-rss"> </i></a>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="logo">
										<a href="index.html"><img src="{{ asset('assets/img/logo.png') }}" alt="Tech NewsLogo"></a>
									</div>
								</div>
								<div class="col-md-4">
									<div class="right_section">
										<ul class="nav navbar-nav">
											<li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle"><i
												class="fa fa-search"></i></a>
												<ul class="dropdown-menu">
													<li>
														<div class="head-search">
															<form role="form">
																<div class="input-group">
																	<input type="text" class="form-control"
																	placeholder="Type Something"> <span class="input-group-btn">
																		<button type="submit" class="btn btn-primary">Search
																		</button>
																	</span>
																</div>
															</form>
														</div>
													</li>
												</ul>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<div class="navigation-section">
							<nav class="navbar m-menu navbar-default">
								<div class="container">
									<div class="navbar-header">
										<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
										data-target="#navbar-collapse-1"><span class="sr-only">Toggle navigation</span> <span
										class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
									</div>
									<div class="collapse navbar-collapse" id="#navbar-collapse-1">
										<ul class="nav navbar-nav main-nav">
											<li class="active"><a href="index.html">News</a></li>
											<li><a href="category.html">Mobile</a></li>
											<li><a href="blog.html">Tablet</a></li>
											<li><a href="blog.html">Gadgets</a></li>
											<li><a href="blog.html">Camera</a></li>
											<li><a href="blog.html">Design</a></li>
										</ul>
									</div>
								</div>
							</nav>
						</div>
					</div>
				</section>
				@yield('content')
				<section id="footer_section" class="footer_section">
					<div class="footer_bottom_Section">
						<div class="container">
							<div class="row">
								<div class="footer">
									<center><p>&copy; Copyright 2016-Tech News . Design by: <a href="https://uicookies.com">uiCookies</a></p></center>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
		<a href="#" class="crunchify-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
		<div class="uc-mobile-menu uc-mobile-menu-effect">
			<button type="button" class="close" aria-hidden="true" data-toggle="offcanvas"
			id="uc-mobile-menu-close-btn">&times;</button>
			<div>
				<div>
					<ul id="menu">
						<li class="active"><a href="blog.html">News</a></li>
						<li><a href="category.html">Mobile</a></li>
						<li><a href="blog.html">Tablet</a></li>
						<li><a href="category.html">Gadgets</a></li>
						<li><a href="blog.html">Camera</a></li>
						<li><a href="category.html">Design</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<script src="{{ asset('assets/js/jquery-2.1.4.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/mobile-menu.js') }}"></script>
	<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('assets/js/script.js') }}"></script>
	@stack('scripts')
</body>
</html>