@extends('layouts.default')
@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/blog.css') }}" />
@endpush
@section('content')
<section id="breadcrumbs" class="breadcrumbs">
	<div class="container">
		<div class="d-flex justify-content-between align-items-center">
			<h2>News/Event</h2>
			<ol>
				<li><a href="/">Home</a></li>
				<li>News/Event</li>
			</ol>
		</div>
	</div>
</section>
<section id="blog" class="blog">
	<div class="container" data-aos="fade-up">
		<div class="row">
			<div class="col-lg-8 entries">
				<article class="entry entry-single">
					<div class="entry-img">
						<img src="{{ asset($bulletin->image) }}" alt="{{ $bulletin->title }}" class="img-fluid">
					</div>
					<h2 class="entry-title">{{ $bulletin->title }}</h2>
					<div class="entry-meta">
						<ul>
							<li class="d-flex align-items-center"><i class="bi bi-clock"></i> <time datetime="{{ date('d-M-Y H:i', strtotime($bulletin->published_at)) }}">{{ date('d-M-Y H:i', strtotime($bulletin->published_at)) }}</time></li>
						</ul>
					</div>
					<div class="entry-content">{!! $bulletin->description !!}</div>
				</article>
			</div>
			<div class="col-lg-4">
				<div class="sidebar">
					<h3 class="sidebar-title">Search</h3>
					<div class="sidebar-item search-form">
						<form action="">
							<input type="text">
							<button type="submit"><i class="bi bi-search"></i></button>
						</form>
					</div>
					<h3 class="sidebar-title">Categories</h3>
					<div class="sidebar-item categories">
						<ul>
							<li><a href="#" class="fw-bold text-primary">- All</a></li>
							<li><a href="#">- Monthly Culture</a></li>
							<li><a href="#">- Company Bulletin</a></li>
							<li><a href="#">- Employee Challenge</a></li>
							<li><a href="#">- Up coming company event</a></li>
						</ul>
					</div>
					<h3 class="sidebar-title">Recent Posts</h3>
					<div class="sidebar-item recent-posts">
						<div class="post-item clearfix">
							<img src="{{ asset('assets/img/blog/blog-recent-1.jpg') }}" alt="">
							<h4><a href="{{ url('bulletin/sample-bulletin') }}">Nihil blanditiis at in nihil autem</a></h4>
							<time datetime="2020-01-01">Jan 1, 2020</time>
						</div>
						<div class="post-item clearfix">
							<img src="{{ asset('assets/img/blog/blog-recent-2.jpg') }}" alt="">
							<h4><a href="{{ url('bulletin/sample-bulletin') }}">Quidem autem et impedit</a></h4>
							<time datetime="2020-01-01">Jan 1, 2020</time>
						</div>
						<div class="post-item clearfix">
							<img src="{{ asset('assets/img/blog/blog-recent-3.jpg') }}" alt="">
							<h4><a href="{{ url('bulletin/sample-bulletin') }}">Id quia et et ut maxime similique occaecati ut</a></h4>
							<time datetime="2020-01-01">Jan 1, 2020</time>
						</div>
						<div class="post-item clearfix">
							<img src="{{ asset('assets/img/blog/blog-recent-4.jpg') }}" alt="">
							<h4><a href="{{ url('bulletin/sample-bulletin') }}">Laborum corporis quo dara net para</a></h4>
							<time datetime="2020-01-01">Jan 1, 2020</time>
						</div>
						<div class="post-item clearfix">
							<img src="{{ asset('assets/img/blog/blog-recent-5.jpg') }}" alt="">
							<h4><a href="{{ url('bulletin/sample-bulletin') }}">Et dolores corrupti quae illo quod dolor</a></h4>
							<time datetime="2020-01-01">Jan 1, 2020</time>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection