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
				@if($seo_category != null) <h5 class="mb-3 text-danger fw-bold">Category : {{ ucwords(str_replace('-', ' ', $seo_category)) }}</h5> @endif
				<div id="container_articles">
					@foreach($bulletins as $b)
					<article class="entry">
						<div class="entry-img">
							<img src="{{ asset($b->image) }}" alt="{{ $b->title }}" class="img-fluid">
						</div>
						<h2 class="entry-title">
							<a href="{{ url('bulletin/'.$b->seo_category.'/'.$b->seo_title) }}">{{ $b->title }}</a>
						</h2>
						<div class="entry-meta">
							<ul>
								<li class="d-flex align-items-center"><i class="bi bi-clock"></i> <time datetime="{{ date('d-M-Y, H:i', strtotime($b->published_at)) }}">{{ date('d-M-Y H:i', strtotime($b->published_at)) }}</time></li>
							</ul>
						</div>
						<div class="entry-content">
							<p>{{ strip_tags($b->description) }}...</p>
							<div class="read-more">
								<a href="{{ url('bulletin/'.$b->seo_category.'/'.$b->seo_title) }}">Read More</a>
							</div>
						</div>
					</article>
					@endforeach
				</div>
				<center>
					<button class="btn btn-primary" id="btn_load_more">Muat lainnya</button>
					<img src="<?php echo asset('assets/img/loader.gif') ?>" style="display: none;" width="50" id="loading_load_more">
				</center>
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
@push('scripts')
<script src="{{ asset('backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var categorId = <?php echo $category_id ?>;
		var offset = 10;
		$('#btn_load_more').on('click', function(){
			$(this).hide();
			$('#loading_load_more').show();
			$.get('<?php echo url('bulletin/ajax_load_more') ?>/'+offset+'/'+categorId, function(res){
				if (res.success) {
					$('#container_articles').append(res.html)
					$('#btn_load_more').show();
				}
				$('#loading_load_more').hide();
				offset += 10;
			})
		})
	});
</script>
@endpush