@extends('layouts.default')
@push('styles')
<style type="text/css" media="screen">
	.featured .icon-box:hover {
		cursor: pointer;
	}
</style>
@endpush
@section('content')
<section id="breadcrumbs" class="breadcrumbs">
	<div class="container">
		<div class="d-flex justify-content-between align-items-center">
			<h2>Company Policy</h2>
			<ol>
				<li><a href="/">Home</a></li>
				<li>Company Policy</li>
			</ol>
		</div>
	</div>
</section>
<section id="features" class="features">
	<div class="container">
		<div class="section-title">
			<h2>Features</h2>
			<p>Our Company Policy</p>
		</div>
		<div class="row">
			<div class="col-lg-3">
				<ul class="nav nav-tabs flex-column">
					@for ($i=0; $i < count($titles); $i++)
					<li class="nav-item">
						<a class="nav-link @if($i == 0) active show @endif" data-bs-toggle="tab" href="#tab-{{$i}}">{{$titles[$i]}}</a>
					</li>
					@endfor
				</ul>
			</div>
			<div class="col-lg-9 mt-4 mt-lg-0">
				<div class="tab-content">
					@for ($i=0; $i < count($descriptions); $i++)
					<div class="tab-pane @if($i == 0) active show @endif" id="tab-{{$i}}">
						<div class="row">
							<div class="@if($descriptions[$i]['file'] != null && $descriptions[$i]['file'] != '') col-lg-9 @else col-lg-12 @endif details order-2 order-lg-1">{!! $descriptions[$i]['description'] !!}</div>
							@if($descriptions[$i]['file'] != null && $descriptions[$i]['file'] != '')
							<div class="col-lg-3 text-center order-1 order-lg-2 featured">
								<div class="icon-box h-auto" onclick="window.open('{{ asset($descriptions[$i]['file']) }}','_blank')">
									<i class="bi bi-download"></i>
									<p>DOWNLOAD FILE</p>
								</div>
							</div>
							@endif
						</div>
					</div>
					@endfor
				</div>
			</div>
		</div>
	</div>
</section>
@endsection