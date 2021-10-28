@extends('layouts.default')
@section('content')
<section class="position-relative" style="background-color: #0065B3; color: #FFFFFF">
	@guest
	<img class="d-none d-lg-block position-absolute top-0 end-0 gambar_accountable_1" src="{{ asset('frontend/img/gambar_accountable.png') }}" alt="gambar accountable">
	<div class="container pb-5">
		<div class="row">
			<div class="col-lg-6 col-md-12 mb-sm-1 mb-lg-5 position-relative">
				<!-- <img class="d-none d-sm-block d-block" src="assets/gambar_accountable.png" alt="gambar accountable"> -->
				<p class="text-white fs-3 mt-5 lh-sm" style="letter-spacing: 1px;">Semua The EAT-ers pasti <em><strong>accountable</strong></em>, saatnya saling berbagi kisah!</p>
			</div>
			<div class="col-lg-8 col-md-6 col-sm-12">
				<h1 class="text-white fw-bolder main_title mb-sm-2" style="letter-spacing: 1px; font-size: 4em; color: #FF8F16 !important">Share your accountable story!</h1>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="card mt-md-4" style="background: #FFCE08; border-radius: 10%;">
					<div class="card-body">
						<h3 class="card-title text-center fw-bolder" style="color: #006DC8">Hello The EAT-er!</h3>
						<form method="POST" action="{{ route('login') }}">
							@csrf
							<input id="email" type="email" name="email" class="form-control border border-primary border-5 rounded-pill mb-2" required placeholder="Email Address" value="{{ old('email') }}">
							<input type="password" name="password" class="form-control border border-primary border-5 rounded-pill" required placeholder="Password" autocomplete="current-password">
							<div class="d-grid mt-4">
								<button class="btn btn-info rounded-pill btn-block fw-bold text-white">Log in</button>
							</div>
						</form>
						@if (Route::has('password.request'))
						<center class="mt-1"><a href="{{ route('password.request') }}" class="text-decoration-underline text-center fs-5">Forgot your password?</a></center>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	@else
	<div class="container pb-5">
		<div class="row">
			<div class="col-12 text-center mt-4">
				<h1 class="text-center text-uppercase mb-0" style="color: #FF8F16">Welcome {{ Auth::user()->name }}</h1>
				<p class="fs-3">Have a great day!</p>
			</div>
			<div class="col-lg-8 col-md-6 col-sm-12">
				<img src="{{ asset('frontend/img/laptop.png') }}" class="position-absolute bottom-0 start-0 img-fluid" alt="laptop" width="700">
			</div>
			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="card mt-md-4" style="background: #E23247; border-radius: 10%;">
					<div class="card-body position-relative">
						<h3 class="card-title text-center fw-bolder">ATTENDANCE</h3>
						<div class="card mb-3">
							<div class="card-body d-flex align-items-center">
								<img src="{{ asset(Auth::guard('web')->user()->photo) }}" class="rounded-circle" width="60" alt="">
								<div class="flex-grow-1 ms-1">
									<p class="fw-bold fs-08 m-0 text-muted">Thrusday, April 29</p>
									<p class="fw-bold fs-08 m-0 text-warning">Click here to checkout</p>
								</div>
								<div>
									<p class="fw-bold fs-08 m-0 text-muted">04:16 PM</p>
									<p class="fw-bold fs-08 m-0 text-black-50">WORKING</p>
								</div>
							</div>
						</div>
						<button class="btn btn-light rounded-pill btn-block fw-bold">Add Attendance</button>
						<div style="margin-top: 7rem">
							<img src="{{ asset('frontend/img/logo-jojotimes.jpg') }}" width="200" class="position-absolute bottom-0 start-50 translate-middle-x" alt="jojotimes">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endguest
</section>
<section>
	<div class="container mt-5 mb-5">
		<ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
			<li class="nav-item" role="presentation">
				<a class="nav-link fw-bold fs-5 py-4 active" id="ex3-tab-1" data-mdb-toggle="pill" href="#ex3-pills-1" role="tab" aria-controls="ex3-pills-1" aria-selected="true">POLICY</a>
			</li>
			<li class="nav-item" role="presentation">
				<a class="nav-link fw-bold fs-5 py-4" id="ex3-tab-2" data-mdb-toggle="pill" href="#ex3-pills-2" role="tab" aria-controls="ex3-pills-2" aria-selected="false">GUIDE</a>
			</li>
			<li class="nav-item" role="presentation">
				<a class="nav-link fw-bold fs-5 py-4" id="ex3-tab-3" data-mdb-toggle="pill" href="#ex3-pills-3" role="tab" aria-controls="ex3-pills-3" aria-selected="false">ORDER</a>
			</li>
		</ul>
		<div class="tab-content" id="ex2-content">
			<div class="tab-pane fade show active" id="ex3-pills-1" role="tabpanel" aria-labelledby="ex3-tab-1">
				<div class="accordion" id="accordionExample">
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingOne">
							<button class="accordion-button fw-bold" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								APANDUAN MEMESAN ANTERAJA
							</button>
						</h2>
						<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-mdb-parent="#accordionExample">
							<div class="accordion-body">
								<strong>This is the first item's accordion body.</strong> It is hidden by default,
								until the collapse plugin adds the appropriate classes that we use to style each
								element. These classes control the overall appearance, as well as the showing and
								hiding via CSS transitions. You can modify any of this with custom CSS or
								overriding our default variables. It's also worth noting that just about any HTML
								can go within the <strong>.accordion-body</strong>, though the transition does
								limit overflow.
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingTwo">
							<button class="accordion-button fw-bold collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								PANDUAN MEMESAN GRAB FOR BUSSINESS
							</button>
						</h2>
						<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-mdb-parent="#accordionExample">
							<div class="accordion-body">
								<strong>This is the second item's accordion body.</strong> It is hidden by
								default, until the collapse plugin adds the appropriate classes that we use to
								style each element. These classes control the overall appearance, as well as the
								showing and hiding via CSS transitions. You can modify any of this with custom CSS
								or overriding our default variables. It's also worth noting that just about any
								HTML can go within the <strong>.accordion-body</strong>, though the transition
								does limit overflow.
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingThree">
							<button class="accordion-button fw-bold collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								PANDUAN MENGIRIM PAKET
							</button>
						</h2>
						<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-mdb-parent="#accordionExample">
							<div class="accordion-body">
								<strong>This is the third item's accordion body.</strong> It is hidden by default,
								until the collapse plugin adds the appropriate classes that we use to style each
								element. These classes control the overall appearance, as well as the showing and
								hiding via CSS transitions. You can modify any of this with custom CSS or
								overriding our default variables. It's also worth noting that just about any HTML
								can go within the <strong>.accordion-body</strong>, though the transition does
								limit overflow.
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="ex3-pills-2" role="tabpanel" aria-labelledby="ex3-tab-2">
				<div class="accordion" id="accordionExample">
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingOne">
							<button class="accordion-button fw-bold" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								APANDUAN MEMESAN ANTERAJA
							</button>
						</h2>
						<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-mdb-parent="#accordionExample">
							<div class="accordion-body">
								<strong>This is the first item's accordion body.</strong> It is hidden by default,
								until the collapse plugin adds the appropriate classes that we use to style each
								element. These classes control the overall appearance, as well as the showing and
								hiding via CSS transitions. You can modify any of this with custom CSS or
								overriding our default variables. It's also worth noting that just about any HTML
								can go within the <strong>.accordion-body</strong>, though the transition does
								limit overflow.
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingTwo">
							<button class="accordion-button fw-bold collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								PANDUAN MEMESAN GRAB FOR BUSSINESS
							</button>
						</h2>
						<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-mdb-parent="#accordionExample">
							<div class="accordion-body">
								<strong>This is the second item's accordion body.</strong> It is hidden by
								default, until the collapse plugin adds the appropriate classes that we use to
								style each element. These classes control the overall appearance, as well as the
								showing and hiding via CSS transitions. You can modify any of this with custom CSS
								or overriding our default variables. It's also worth noting that just about any
								HTML can go within the <strong>.accordion-body</strong>, though the transition
								does limit overflow.
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingThree">
							<button class="accordion-button fw-bold collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								PANDUAN MENGIRIM PAKET
							</button>
						</h2>
						<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-mdb-parent="#accordionExample">
							<div class="accordion-body">
								<strong>This is the third item's accordion body.</strong> It is hidden by default,
								until the collapse plugin adds the appropriate classes that we use to style each
								element. These classes control the overall appearance, as well as the showing and
								hiding via CSS transitions. You can modify any of this with custom CSS or
								overriding our default variables. It's also worth noting that just about any HTML
								can go within the <strong>.accordion-body</strong>, though the transition does
								limit overflow.
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="ex3-pills-3" role="tabpanel"aria-labelledby="ex3-tab-3">
				<div class="accordion" id="accordionExample">
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingOne">
							<button class="accordion-button fw-bold" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								APANDUAN MEMESAN ANTERAJA
							</button>
						</h2>
						<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-mdb-parent="#accordionExample">
							<div class="accordion-body">
								<strong>This is the first item's accordion body.</strong> It is hidden by default,
								until the collapse plugin adds the appropriate classes that we use to style each
								element. These classes control the overall appearance, as well as the showing and
								hiding via CSS transitions. You can modify any of this with custom CSS or
								overriding our default variables. It's also worth noting that just about any HTML
								can go within the <strong>.accordion-body</strong>, though the transition does
								limit overflow.
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingTwo">
							<button class="accordion-button fw-bold collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								PANDUAN MEMESAN GRAB FOR BUSSINESS
							</button>
						</h2>
						<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-mdb-parent="#accordionExample">
							<div class="accordion-body">
								<strong>This is the second item's accordion body.</strong> It is hidden by
								default, until the collapse plugin adds the appropriate classes that we use to
								style each element. These classes control the overall appearance, as well as the
								showing and hiding via CSS transitions. You can modify any of this with custom CSS
								or overriding our default variables. It's also worth noting that just about any
								HTML can go within the <strong>.accordion-body</strong>, though the transition
								does limit overflow.
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingThree">
							<button class="accordion-button fw-bold collapsed" type="button" data-mdb-toggle="collapse" data-mdb-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								PANDUAN MENGIRIM PAKET
							</button>
						</h2>
						<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-mdb-parent="#accordionExample">
							<div class="accordion-body">
								<strong>This is the third item's accordion body.</strong> It is hidden by default,
								until the collapse plugin adds the appropriate classes that we use to style each
								element. These classes control the overall appearance, as well as the showing and
								hiding via CSS transitions. You can modify any of this with custom CSS or
								overriding our default variables. It's also worth noting that just about any HTML
								can go within the <strong>.accordion-body</strong>, though the transition does
								limit overflow.
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection