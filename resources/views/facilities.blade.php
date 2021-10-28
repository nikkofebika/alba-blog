@extends('layouts.default')
@push('styles')
<style type="text/css" media="screen">
	.featured .row .icon-box:hover {
		cursor: pointer;
	}
</style>
@endpush
@section('content')
<section id="breadcrumbs" class="breadcrumbs">
	<div class="container">
		<div class="d-flex justify-content-between align-items-center">
			<h2>Facilities</h2>
			<ol>
				<li><a href="/">Home</a></li>
				<li>Facilities</li>
			</ol>
		</div>
	</div>
</section>
<section class="featured">
	<div class="container">
		<div class="row">
			@foreach($facilities as $f)
			<div class="col-md-3 col-sm-6 mb-4">
				<div class="icon-box text-center" onclick="window.open('<?php echo $f->url ?>','_blank')">
					<img src="{{ asset($f->image) }}" alt="{{$f->name}}" width="130">
					<h3 class="mt-3">{{ $f->name }}</h3>
				</div>
			</div>
			@endForeach
		</div>
	</div>
</section>
@endsection