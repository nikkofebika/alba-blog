@extends('layouts.default')
@push('styles')
<style type="text/css" media="screen">
	.featured .row .icon-box:hover {
		cursor: pointer;
	}
</style>
@endpush
@section('content')
<section class="featured">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<div class="icon-box text-center" onclick="window.open('http://traveloka.com','_blank')">
					<img src="{{ asset('images/facilities/home.png') }}" alt="car" width="150">
					<h3>Traveloka</h3>
				</div>
			</div>
			<div class="col-lg-3 mt-4 mt-lg-0">
				<div class="icon-box text-center">
					<i class="bi bi-bar-chart"></i>
					<h3>Grab</h3>
				</div>
			</div>
			<div class="col-lg-3 mt-4 mt-lg-0">
				<div class="icon-box text-center">
					<i class="bi bi-binoculars"></i>
					<h3>JNE</h3>
				</div>
			</div>
			<div class="col-lg-3 mt-4 mt-lg-0">
				<div class="icon-box text-center">
					<i class="bi bi-binoculars"></i>
					<h3>Blue Bird</h3>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection