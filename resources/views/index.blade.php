@extends('layouts.default')
@push('styles')
<link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<section id="hero">
	<div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
		<ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
		<div class="carousel-inner" role="listbox">
			@for($i = 0; $i < count($articles); $i++)
			<div class="carousel-item @if($i==0) active @endif" style="background-image: url({{ asset($articles[$i]->image) }})">
				<div class="carousel-container">
					<div class="container">
						<h2 class="animate__animated animate__fadeInDown">{{ $articles[$i]->title }}</h2>
						<p class="animate__animated animate__fadeInUp">{{strip_tags($articles[$i]->description)}}...</p>
						@auth
						<a href="{{ url('bulletin/'.$articles[$i]->seo_category.'/'.$articles[$i]->seo_title) }}" class="btn-get-started">Selengkapnya</a>
						@else
						<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#mdlLogin" class="btn-get-started">Selengkapnya</a>
						@endauth
					</div>
				</div>
			</div>
			@endfor
		</div>
		<a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
			<span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
		</a>
		<a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
			<span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
		</a>
	</div>
</section>
@auth
<section id="about" class="about">
	<div class="container">
		<div class="row content">
			<div class="col-12">
				<div class="section-title pb-3">
					<p>Tentang Kami</p>
				</div>
				<p>Triputra Energi Megatara (TEM) adalah sebuah perusahaan jual-beli energi di Indonesia yang menyediakan solusi energi dengan kualitas terbaik serta harga yang kompetitif untuk para pelanggan di industri tersebut.</p>
				<p>Bergerak di bawah naungan Triputra Group, TEM telah dipercaya oleh ExxonMobil untuk mendistribusikan minyak diesel untuk kendaraan ke Kalimantan dan bagian Indonesia timur lainnya sejak 2018. Sebagai sebuah perusahaan yang terus bertumbuh, kami berencana memperluas cakupan layanan kami agar dapat memasuki semua bidang usaha di seluruh pelosok negeri serta mengembangkan produk-produk kami.</p>
				<p>Triputra Energi Megatara (TEM) adalah sebuah perusahaan jual-beli energi di Indonesia yang menyediakan solusi energi dengan kualitas terbaik serta harga yang kompetitif untuk para pelanggan di industri tersebut.</p>
				<p>Bergerak di bawah naungan Triputra Group, TEM telah dipercaya oleh ExxonMobil untuk mendistribusikan minyak diesel untuk kendaraan ke Kalimantan dan bagian Indonesia timur lainnya sejak 2018. Sebagai sebuah perusahaan yang terus bertumbuh, kami berencana memperluas cakupan layanan kami agar dapat memasuki semua bidang usaha di seluruh pelosok negeri serta mengembangkan produk-produk kami.</p>
			</div>
		</div>
	</div>
</section>
<section id="team" class="team section-bg pt-4">
	<div class="container">
		<div class="section-title pb-0">
			<p>Tim Kami</p>
		</div>
		<div class="row">
			@foreach($teams as $t)
			<div class="col-lg-6 mt-4">
				<div class="member d-flex align-items-start">
					<div class="pic" style="height: 125px; width: 125px;"><img src="{{ asset($t->image) }}" class="img-fluid" alt="{{$t->name}}"></div>
					<div class="member-info">
						<h4>{{$t->name}}</h4>
						<span>{{$t->position}}</span>
						<div class="social mt-4">
							@foreach(json_decode($t->socmed,true) as $m => $link)
							@if($link != '')
							<a href="{{$link}}" class="{{$m}}" target="_blank"><i class="ri-{{$m}}-fill"></i></a>
							@endif
							@endforeach
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>
@endauth
{{-- <section>
	<div class="container">
		<h5>Artikel Terbaru</h5>
		<hr class="mt-1 text-danger opacity-100" style="height: 3px;">
		<div class="swiper mySwiper">
			<div class="swiper-wrapper mb-4">
				@foreach($articles as $a)
				<a href="{{ url('bulletin/'.$a->seo_title) }}">
					<div class="card mb-3 shadow swiper-slide">
						<img data-src="{{ asset('assets/img/blog/blog-1.jpg') }}" class="card-img-top swiper-lazy" alt="{{ $a->title }}">
						<div class="swiper-lazy-preloader"></div>
						<div class="card-body">
							<a href="{{ url('bulletin/'.$a->seo_title) }}" class="text-black"><h6 class="card-title">{{ $a->title }}</h6></a>
							<p class="card-text"><small class="text-muted"><?php echo date('d-M-Y H:i', strtotime($a->published_at)) ?></small></p>
						</div>
					</div>
				</a>
				@endForeach
			</div>
			<div class="swiper-pagination"></div>
		</div>
	</div>
</section> --}}
@endsection
@push('scripts')
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script type="text/javascript">
	var swiper = new Swiper(".mySwiper", {
		preloadImages: false,
		lazy: true,
		spaceBetween: 20,
		grabCursor: true,
		breakpoints: {
			480: {
				slidesPerView: 1,
			},
			768: {
				slidesPerView: 2,
			},
			992: {
				slidesPerView: 3,
			},
		},
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
		},
	});
</script>
@endpush