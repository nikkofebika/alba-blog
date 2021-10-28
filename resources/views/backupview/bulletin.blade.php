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
					<li class="breadcrumb-item"><a href="#">Bulletin</a></li>
				</ol>
				<h4>Bulletin</h4>
			</nav>
		</div>
	</nav>
</section>
<section id="blog" class="blog mt-3">
	<div class="container" data-aos="fade-up">
		<div class="row">
			<div class="col-lg-8 entries">
				@forelse ($bulletins as $b)
				<article class="entry">
					<div class="entry-img">
						<img src="{{ $b->image }}" alt="{{ $b->title }}" class="img-fluid">
					</div>
					<h2 class="entry-title">
						<a href="{{ url('bulletin/'.$b->seo_title) }}">{{ $b->title }}</a>
					</h2>
					<div class="entry-meta">
						<ul>
							<!-- <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-single.html">John Doe</a></li> -->
							<li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-single.html"><time datetime="{{ date('d M Y H:i', strtotime($b->published_at)) }}">{{ date('d M Y H:i', strtotime($b->published_at)) }}</time></a></li>
							<!-- <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-single.html">12 Comments</a></li> -->
						</ul>
					</div>
					<div class="entry-content">
						<p><?php echo substr(strip_tags($b->description), 0, 200) ?>...</p>
						<div class="text-end">
							<a href="{{ url('bulletin/'.$b->seo_title) }}" class="btn btn-primary">Selengkapnya</a>
						</div>
					</div>
				</article>
				@empty
				<div class="alert alert-info">Belum ada bulletin</div>
				@endforelse

				{{ $bulletins->links() }}


				

			</div><!-- End blog entries list -->

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