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
						<h3>{{$posts}}</h3>
						<p>Post</p>
					</div>
					<div class="icon">
						<i class="fa fa-newspaper-o"></i>
					</div>
					<a href="{{ url('console/posts') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
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
						<h3>{{$tags}}</h3>
						<p>Tags</p>
					</div>
					<div class="icon">
						<i class="fa fa-bookmark-o"></i>
					</div>
					<a href="{{ url('console/tags') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<div class="small-box bg-red">
					<div class="inner">
						<h3>{{$categories}}</h3>
						<p>Categories</p>
					</div>
					<div class="icon">
						<i class="fa fa-list"></i>
					</div>
					<a href="{{ url('console/categories') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection