@extends('bulletin.layout')
@section('layout_article')
<article class="entry entry-single">
	<div class="entry-img">
		<img src="{{ asset($bulletin->image) }}" alt="{{ $bulletin->title }}" class="img-fluid">
	</div>
	<h2 class="entry-title">{{ $bulletin->title }}</h2>
	<div class="entry-meta">
		<ul>
			<li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="javascript:void;"><time datetime="{{ date('d-M-Y H:i', strtotime($bulletin->published_at)) }}">{{ date('d-M-Y H:i', strtotime($bulletin->published_at)) }}</time></a></li>
		</ul>
	</div>
	<div class="entry-content">{!! $bulletin->description !!}</div>
</article>
@endsection