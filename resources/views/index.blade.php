@extends('layouts.default')
@section('content')
@if($seo_category != null) <h5 class="mb-3 text-danger fw-bold">Category : {{ ucwords(str_replace('-', ' ', $seo_category)) }}</h5> @endif
<div id="container_articles">
	@forelse($posts as $b)
	<article class="entry">
		<div class="entry-img">
			<img src="{{ asset($b->image) }}" alt="{{ $b->title }}" class="img-fluid">
		</div>
		<h2 class="entry-title">
			<a href="{{ url($b->seo_category.'/'.$b->seo_title) }}">{{ $b->title }}</a>
		</h2>
		<div class="entry-meta">
			<ul>
				<li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-single.html">{{ $b->name }}</a></li>
				<li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="javascript:void;"><time datetime="{{ date('d-M-Y H:i', strtotime($b->published_at)) }}">{{ date('d-M-Y H:i', strtotime($b->published_at)) }}</time></a></li>
			</ul>
		</div>
		<div class="entry-content">
			<p>{{ substr(strip_tags($b->description), 0, 50) }}...</p>
			<div class="read-more">
				<a href="{{ url($b->seo_category.'/'.$b->seo_title) }}">Read More</a>
			</div>
		</div>
	</article>
	@empty
	<div class="alert alert-warning">Tidak ada data post</div>
	@endforelse
</div>
@if(count($posts) > 0)
<center>
	<button class="btn btn-primary" id="btn_load_more">Muat lainnya</button>
	<img src="<?php echo asset('assets/img/loader.gif') ?>" style="display: none;" width="50" id="loading_load_more">
</center>
@endif
@endsection
@push('scripts')
<script src="{{ asset('backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var categorId = <?php echo $category_id ?>;
		var offset = 5;
		$('#btn_load_more').on('click', function(){
			$(this).hide();
			$('#loading_load_more').show();
			$.get('<?php echo url('ajax_load_more') ?>/'+offset+'/'+categorId, function(res){
				if (res.success) {
					$('#container_articles').append(res.html)
					$('#btn_load_more').show();
				}
				$('#loading_load_more').hide();
				offset += 5;
			})
		})
	});
</script>
@endpush