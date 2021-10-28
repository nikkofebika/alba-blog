@extends('console.layouts.master')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Dashboard</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3>{{$articles}}</h3>
						<p>Bulletin</p>
					</div>
					<div class="icon">
						<i class="fa fa-newspaper-o"></i>
					</div>
					<a href="{{ url('console/articles') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-green">
					<div class="inner">
						<h3>{{$users}}</h3>
						<p>User</p>
					</div>
					<div class="icon">
						<i class="fa fa-users"></i>
					</div>
					<a href="{{ url('console/users') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3>{{$admins}}</h3>
						<p>Admin</p>
					</div>
					<div class="icon">
						<i class="fa fa-users"></i>
					</div>
					<a href="{{ url('console/users') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3>{{$facilities}}</h3>
						<p>Fasilitas</p>
					</div>
					<div class="icon">
						<i class="fa fa-bookmark-o"></i>
					</div>
					<a href="{{ url('console/facilities') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3>{{$rooms}}</h3>
						<p>Ruangan</p>
					</div>
					<div class="icon">
						<i class="fa fa-home"></i>
					</div>
					<a href="{{ url('console/rooms') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="box box-info">
					<div class="box-header with-border">
						<i class="fa fa-info"></i>
						<h3 class="box-title">Informasi</h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-lg-6">
								<h4 class="text-bold">Link download icon</h4>
								<ol>
									<li><a href="https://www.svgrepo.com/" target="_blank" class="text-bold">SVGREPO <i class="fa fa-link"></i></a></li>
									<li><a href="https://icons8.com/" target="_blank" class="text-bold">ICONS8 <i class="fa fa-link"></i></a></li>
									<li><a href="https://www.flaticon.com/" target="_blank" class="text-bold">FLATICON <i class="fa fa-link"></i></a></li>
									<li><a href="https://freeicons.io/" target="_blank" class="text-bold">FREEICONS <i class="fa fa-link"></i></a></li>
								</ol>
							</div>
							<div class="col-lg-6">
								<h4 class="text-bold">Link compress gambar</h4>
								<ol>
									<li><a href="https://tinypng.com/" target="_blank" class="text-bold">TINYPNG <i class="fa fa-link"></i></a></li>
								</ol>
								<h4 class="text-bold">Link compress pdf</h4>
								<ol>
									<li><a href="https://smallpdf.com/id/mengompres-pdf" target="_blank" class="text-bold">SMALLPDF <i class="fa fa-link"></i></a></li>
									<li><a href="https://www.ilovepdf.com/compress_pdf" target="_blank" class="text-bold">ILOVEPDF <i class="fa fa-link"></i></a></li>
								</ol>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	@endsection