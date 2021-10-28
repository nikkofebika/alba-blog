@extends('layouts.default')
@push('styles')
<link rel="stylesheet" href="{{ asset('frontend/css/blog.css') }}" />
@endpush
@section('content')
<section>
	<nav class="navbar navbar-expand-lg py-3" style="background-color: #d5ebed">
		<div class="container">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="/" class="text-primary">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ url('/bulletin') }}" class="text-primary">Bulletin</a></li>
				</ol>
				<h4>{{$bulletin->title}}</h4>
			</nav>
		</div>
	</nav>
</section>
<section id="blog" class="blog mt-3">
	<div class="container" data-aos="fade-up">
		<div class="row">
			<div class="col-lg-8 col-md-12">
				<div class="card shadow mb-3">
					<img src="{{ $bulletin->image }}" class="card-img-top" alt="{{ $bulletin->title }}" />
					<div class="card-body">
						<h1 class="card-title">{{ $bulletin->title }}</h1>
						<p class="card-text"><?php echo $bulletin->description ?></p>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="sidebar">

					<h3 class="sidebar-title">Search</h3>
					<div class="sidebar-item search-form">
						<form action="">
							<input type="text" class="form-control" placeholder="Search...">
							<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
						</form>
					</div>

					<h3 class="sidebar-title">Recent Posts</h3>
					<div class="sidebar-item recent-posts">
						@foreach($recent_bulletins as $b)
						<div class="post-item clearfix">
							<img src="{{ asset($b->image) }}" alt="{{ $b->title }}">
							<h4><a href="{{ url('bulletin/'.$b->seo_title) }}">{{ $b->title }}</a></h4>
							<time datetime="{{ date('d-m-Y', strtotime($b->published_at)) }}">{{ date('d M Y', strtotime($b->published_at)) }}</time>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection