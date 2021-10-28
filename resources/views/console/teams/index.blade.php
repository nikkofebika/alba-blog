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
						<a href="{{ url('console/teams/create') }}" title="Tambah Data" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Data</a>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table id="datatable" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Jabatan</th>
										<th>Foto</th>
										<th>Urutan</th>
										<th>Aktif</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($teams as $t): ?>
										<tr>
											<td>{{$no++}}</td>
											<td>{{ $t->name }}</td>
											<td>{{ $t->position }}</td>
											<td>
												<a href="{{ asset($t->image) }}" target="_blank"><img src="{{ asset($t->image) }}" width="60"></a>
											</td>
											<td>{{ $t->priority }}</td>
											<td><input type="checkbox" <?php echo $t->approved_by != null ? 'checked' : '' ?> class="check_approve" data-team_id="{{ $t->id }}" /></td>
											<td>
												<a href="{{ url('console/teams/'.$t->id.'/edit') }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
												<form method="POST" onsubmit="return confirm('Hapus <?php echo $t->name ?> ?')" action="{{ route('console.teams.destroy',$t->id) }}" class="d-inline">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></button></form>
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
				ajax_approve_team($(this).data('team_id'),1);
			} else {
				ajax_approve_team($(this).data('team_id'),0);
			}
		});
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		function ajax_approve_team(id,val){
			$.post(`{{ url('console/teams/ajax_approve_team') }}`, {team_id:id, val:val}, function(res){
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