@extends('layouts.default')
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
				@yield('layout_article')
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
							<li><a href="{{ url('bulletin') }}" class="@if($category_id == 0) fw-bold text-primary @endif">- All</a></li>
							@foreach($categories as $c)
							<li><a href="{{ url('bulletin/'.$c->seo_title) }}" class="@if($category_id == $c->id) fw-bold text-primary @endif">- {{ $c->title }}</a></li>
							@endforeach
						</ul>
					</div>
					<h3 class="sidebar-title">Recent Posts</h3>
					<div class="sidebar-item recent-posts">
						@foreach($recent_bulletins as $rb)
						<div class="post-item clearfix">
							<a href="{{ url('bulletin/'.$rb->seo_category.'/'.$rb->seo_title) }}"><img src="{{ asset($rb->image) }}" alt="{{ $rb->title }}"></a>
							<h4><a href="{{ url('bulletin/'.$rb->seo_category.'/'.$rb->seo_title) }}">{{ $rb->title }}</a></h4>
							<time datetime="{{ date('d-M-Y H:i', strtotime($rb->published_at)) }}">{{ date('d-M-Y H:i', strtotime($rb->published_at)) }}</time>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection