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
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table id="datatable" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>User</th>
										<th>Keterangan</th>
										<th>Bukti</th>
										<th>Total</th>
										<th>Status</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>Eko Kurniawan</td>
										<td>Rapid Test PCR</td>
										<td><a href="{{ asset('images/medical/bukti_medical.jpg') }}" target="_blank"><img src="{{ asset('images/medical/bukti_medical.jpg') }}" width="100"></a></td>
										<td>Rp. 500.000</td>
										<th><button class="btn btn-success btn-xs" data-status="1" data-toggle="modal" data-target="#mdlApprove">Approved</button></th>
										<td>
											<form method="POST" onsubmit="return confirm('Hapus data ?')" action="" class="d-inline">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></button></form>
										</td>
									</tr>
									<tr>
										<td>2</td>
										<td>Ferry</td>
										<td>Medical Check Up</td>
										<td><a href="{{ asset('images/medical/bukti_medical.jpg') }}" target="_blank"><img src="{{ asset('images/medical/bukti_medical.jpg') }}" width="100"></a></td>
										<td>Rp. 180.000</td>
										<th><button class="btn btn-danger btn-xs" data-status="2" data-toggle="modal" data-target="#mdlApprove">Rejected</button></th>
										<td>
											<form method="POST" onsubmit="return confirm('Hapus data ?')" action="" class="d-inline">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></button></form>
										</td>
									</tr>
									<tr>
										<td>3</td>
										<td>Jonathan Marks</td>
										<td>Beli Vitamin</td>
										<td><a href="{{ asset('images/medical/bukti_medical.jpg') }}" target="_blank"><img src="{{ asset('images/medical/bukti_medical.jpg') }}" width="100"></a></td>
										<td>Rp. 350.000</td>
										<th>
											<button class="btn btn-warning btn-xs" data-status="0" data-toggle="modal" data-target="#mdlApprove">Waiting...</button>

										</th>
										<td>
											<form method="POST" onsubmit="return confirm('Hapus data ?')" action="" class="d-inline">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></button></form>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<div class="modal fade" id="mdlApprove">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="formCategory" action="{{ url('console/article-categories') }}" method="post">
				<div class="modal-body">
					@csrf
					<div class="form-group">
						<label>Pilih Status</label>
						<select name="status" class="form-control">
							<option value="0">Waiting</option>
							<option value="1">Approved</option>
							<option value="2">Rejected</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button type="button" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endSection
@push('scripts')
<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
	$(function () {
		$('#datatable').DataTable();
		$('#mdlApprove').on('shown.bs.modal', function(e){
			var mdl = $(e.relatedTarget);
			$("#mdlApprove select[name=status]").val(mdl.data('status'));
			// $("#mdlApprove input[name=title]").val(mdl.data('title'))
		});

		$('#mdlApprove .btn_submit').on('click',function(e) {
			$('#mdlApprove .btn_submit').attr('disabled',true).text('Loading...');
			$.post('/console/article-categories/ajax_cek_category', {title: $("#mdlApprove input[name=title]").val()}, function(res){
				if (!res.success) {
					$('#mdlApprove .text-red').show();
					$('#mdlApprove .btn_submit').attr('disabled',false).text('Simpan');
				} else {
					$('#mdlApprove .text-red').hide();
					$('#mdlApprove form').submit();
				}
			});
		});

		$('body').on('click','.check_active',function() {
			if ($(this).prop('checked')) {
				ajax_active_category($(this).data('category_id'),1)
			} else {
				ajax_active_category($(this).data('category_id'),0)
			}
		});

		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		function ajax_active_category(id,val){
			$.post(`{{ url('console/article-categories/ajax_active_category') }}`, {category_id:id, val:val}, function(res){
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