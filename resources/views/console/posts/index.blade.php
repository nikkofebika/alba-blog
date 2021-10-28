@extends('console.layouts.master')
@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link href="{{ asset('backend/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>{{$page_title}}</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<?php if(session('notification')){echo session('notification');} ?>
						<a href="{{ route('console.posts.create') }}" title="Tambah Data" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Data</a>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table id="datatable" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Judul</th>
										<th>Image</th>
										<th>Tgl Publish</th>
										<th>Slider?</th>
										<th>Aktif?</th>
										<th></th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endSection
@push('scripts')
<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
	$(function () {
		var table = $('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('console.posts.list') }}",
			columns: [
			{data: 'id', name: 'id'},
			{data: 'title', name: 'title'},
			{data: 'image', name: 'image',orderable: false},
			{data: 'published_at', name: 'published_at'},
			{data: 'is_slider', name: 'is_slider'},
			{data: 'approved_by', name: 'approved_by',orderable: false},
			{
				data: 'action', 
				name: 'action',
				orderable: false, 
				searchable: false
			},
			]
		});
		$('body').on('click','.check_approve',function() {
			if ($(this).prop('checked')) {
				ajax_approve_post($(this).data('post_id'),1)
			} else {
				ajax_approve_post($(this).data('post_id'),0)
			}
		});
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		function ajax_approve_post(id,val){
			$.post(`{{ url('console/posts/ajax_approve_post') }}`, {post_id:id, val:val}, function(res){
				if (res.success){
					toastr.success(res.message);
				} else {
					toastr.error(res.message);
				}
			},'json')
		}
	});
</script>
@endpush