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
						<a href="{{ url('console/company-policies/create') }}" title="Tambah Data" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Data</a>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table id="datatable" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Judul</th>
										<th>File</th>
										<th>Urutan</th>
										<th>Aktif</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($policies as $p): ?>
										<tr>
											<td>{{$no++}}</td>
											<td>{{ $p->title }}</td>
											<td>
												@if($p->file != null && $p->file != '')
												<a href="{{ asset($p->file) }}" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-download"></i> Download file</a>
												@endif
											</td>
											<td>{{ $p->priority }}</td>
											<td><input type="checkbox" <?php echo $p->approved_by != null ? 'checked' : '' ?> class="check_approve" data-policy_id="{{ $p->id }}" /></td>
											<td>
												<a href="{{ url('console/company-policies/'.$p->id) }}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
												<a href="{{ url('console/company-policies/'.$p->id.'/edit') }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
												<form method="POST" onsubmit="return confirm('Hapus <?php echo $p->title ?> ?')" action="{{ route('console.company-policies.destroy', $p->id) }}" class="d-inline">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></button></form>
											</td>
										</tr>
									<?php endforeach ?>
								</tbody>
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
		$('#datatable').DataTable();
		$('body').on('click','.check_approve',function() {
			if ($(this).prop('checked')) {
				ajax_approve_policy($(this).data('policy_id'),1)
			} else {
				ajax_approve_policy($(this).data('policy_id'),0)
			}
		});
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		function ajax_approve_policy(id,val){
			$.post(`{{ url('console/company-policies/ajax_approve_policy') }}`, {policy_id:id, val:val}, function(res){
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