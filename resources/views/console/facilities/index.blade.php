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
						<a href="{{ route('console.facilities.create') }}" title="Tambah Data" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Data</a>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table id="datatable" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Name</th>
										<th width="5%">Url</th>
										<th>Gambar</th>
										<th>Urutan</th>
										<th>Aktif</th>
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
<div class="modal fade" id="mdlShowDetail">
	<div class="modal-dialog">
		<h4 class="text-white"><img src="{{ asset('images/gif/loader2.gif') }}"> Loading...</h4>
	</div>
</div>
@endSection
@push('scripts')
<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
	$(function () {
		$('#mdlShowDetail').on('shown.bs.modal', function(e){
			var id = $(e.relatedTarget).data('id')
			$.get('{{ url("console/facilities") }}/'+id, function(html){
				$('#mdlShowDetail .modal-dialog').html(html)
			})
		}).on('hidden.bs.modal', function(){
			$('#mdlShowDetail .modal-dialog').html(`<h4 class="text-white"><img src="{{ asset('images/gif/loader2.gif') }}"> Loading...</h4>`)
		})
		var table = $('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('console.facilities.list') }}",
			columns: [
			{data: 'id', name: 'id'},
			{data: 'name', name: 'name'},
			{data: 'url', name: 'url'},
			{data: 'image', name: 'image',orderable: false},
			{data: 'priority', name: 'priority'},
			{data: 'is_active', name: 'is_active',orderable: false},
			{
				data: 'action',
				name: 'action',
				orderable: false, 
				searchable: false
			},
			]
		});
		$('body').on('click','.check_active',function() {
			if ($(this).prop('checked')) {
				ajax_active_facility($(this).data('facility_id'),1)
			} else {
				ajax_active_facility($(this).data('facility_id'),0)
			}
		});
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		function ajax_active_facility(id,val){
			$.post(`{{ url('console/facilities/ajax_active_facility') }}`, {facility_id:id, val:val}, function(res){
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