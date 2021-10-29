@extends('layouts.default')
@section('content')
<article class="entry entry-single">
	<div class="entry-img">
		<img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="img-fluid">
	</div>
	<h2 class="entry-title">{{ $post->title }}</h2>
	<div class="entry-meta">
		<ul>
			<li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-single.html">{{ $post->name }}</a></li>
			<li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="javascript:void;"><time datetime="{{ date('d-M-Y H:i', strtotime($post->published_at)) }}">{{ date('d-M-Y H:i', strtotime($post->published_at)) }}</time></a></li>
		</ul>
	</div>
	<div class="entry-content">{!! $post->description !!}</div>
	@if($tags)
	<div class="entry-footer">
		<i class="bi bi-tags"></i>
		<ul class="tags">
			@foreach($tags as $tag)
			<li><a href="#">{{$tag->title}}</a></li>
			@endforeach
		</ul>
	</div>
	@endif
</article>
@endsection