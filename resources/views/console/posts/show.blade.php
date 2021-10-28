@extends('console.layouts.master')
@section('content')
<div class="content-wrapper">
	<section class="content-header d-block">
		<h1 class="d-inline-block">Detail Data</h1>
		<a href="{{ url('console/posts') }}" class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-hover">
								<tr>
									<th width="20%">Judul</th>
									<td>: {{ $post->title }}</td>
								</tr>
								<tr>
									<th>SEO Judul</th>
									<td>: {{ $post->seo_title }}</td>
								</tr>
								@if(!empty($post->tags))
								<tr>
									<th>Tags</th>
									<td>: 
										@foreach($post->tags as $t)
										{{$t->title}},&nbsp;
										@endforeach
									</td>
								</tr>
								@endif
								<tr>
									<th>Tanggal Tayang</th>
									<td>: <?php echo date('d-m-Y H:i', strtotime($post->published_at)) ?> / <?php echo $post->published_at <= date('Y-m-d H:i:s') ? '<span class="label label-primary">Sudah Tayang</span>' : '<span class="label label-warning">Belun Tayang</span>' ?></td>
								</tr>
								<tr>
									<th>Dibuat Oleh</th>
									<td>: {{ $post->user->name }}</td>
								</tr>
								<tr>
									<th>Status</th>
									<td>: <?php echo $post->approved == 1 ? '<span class="label label-primary">Sudah di Approve</span>' : '<span class="label label-warning">Belum di Approve</span>' ?></td>
								</tr>
								<tr>
									<th>Di Approve Oleh</th>
									<td>: {{ $post->approved_by ? $post->approvedby->name : '-' }}</td>
								</tr>
								<tr>
									<th>Dibuat Pada</th>
									<td>: {{ date('d-m-Y H:i', strtotime($post->created_at)) }}</td>
								</tr>
								<tr>
									<th>Deskripsi</th>
									<td>: <?php echo $post->description ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endSection