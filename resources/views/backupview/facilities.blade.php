@extends('layouts.default')

@push('styles')
<style type="text/css">
	.wrimagecard{	
		margin-top: 0;
		margin-bottom: 1.5rem;
		text-align: center;
		position: relative;
		background: #fff;
		box-shadow: 12px 15px 20px 0px rgba(46,61,73,0.15);
		border-radius: 4px;
		transition: all 0.3s ease;
	}
	.wrimagecard .fa{
		position: relative;
		font-size: 70px;
	}
	.wrimagecard-topimage_header{
		padding: 20px;
		background-color: rgba(51, 105, 232, 0.1);
	}
	a.wrimagecard:hover, .wrimagecard-topimage:hover {
		box-shadow: 2px 4px 8px 0px rgba(46,61,73,0.2);
	}
	.wrimagecard-topimage a {
		width: 100%;
		height: 100%;
		display: block;
	}
	.wrimagecard-topimage_title {
		padding: 20px 24px;
		height: 80px;
		padding-bottom: 0.75rem;
		position: relative;
	}
	.wrimagecard-topimage a {
		border-bottom: none;
		text-decoration: none;
		color: #525c65;
		transition: color 0.3s ease;
	}
</style>
@endpush
@section('content')
<section>
	<nav class="navbar navbar-expand-lg py-3" style="background-color: #d5ebed">
		<div class="container">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="/" class="text-primary">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Facilities</a></li>
				</ol>
				<h4>Facilities</h4>
			</nav>
		</div>
	</nav>
</section>
<section class="mt-3">
	<div class="container">
		<div class="row">
			@forelse ($facilities as $f)
			<div class="col-md-3">
				<div class="wrimagecard wrimagecard-topimage">
					<a href="{{ $f->url }}" target="_blank">
						<div class="wrimagecard-topimage_header">
							<img src="{{ asset($f->image) }}" alt="{{ $f->name }}" width="80">
						</div>
						<div class="wrimagecard-topimage_title">
							<h5>{{ $f->name }}</h5>
						</div>
					</a>
				</div>
			</div>
			@empty
			<div class="alert alert-info">Belum ada fasilitas</div>
			@endforelse
		</div>
	</div>
</section>
@endsection