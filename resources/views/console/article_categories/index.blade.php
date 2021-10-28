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
						<button title="Tambah Data" class="btn btn-primary pull-right" data-toggle="modal" data-target="#mdlCreate"><i class="fa fa-plus"></i> Tambah Data</button>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table id="datatable" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Judul</th>
										<th>SEO</th>
										<th>Urutan</th>
										<th>Aktif</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($categories as $c) { ?>
										<tr>
											<td>{{ $no++ }}</td>
											<td>{{ $c->title }}</td>
											<td>{{ $c->seo_title }}</td>
											<td>{{ $c->priority }}</td>
											<td><input type="checkbox" <?php echo $c->approved_by != null ? 'checked' : '' ?> class="check_active" data-category_id="{{ $c->id }}" /></td>
											<td>
												<button class="btn btn-warning btn-xs" data-id="{{ $c->id }}" data-title="{{ $c->title }}" data-priority="{{ $c->priority }}" data-toggle="modal" data-target="#mdlEdit"><i class="fa fa-edit"></i></button>
												<form method="POST" onsubmit="return confirm('Hapus <?php echo $c->title ?> ?')" action="{{ url('console/article-categories/destroy/'.$c->id) }}" class="d-inline">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></button></form>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<div class="modal fade" id="mdlCreate">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Buat Kategori</h4>
			</div>
			<form id="formCategory" action="{{ url('console/article-categories') }}" method="post">
				<div class="modal-body">
					@csrf
					<div class="form-group">
						<label>Title</label>
						<input type="text" name="title" class="form-control" required placeholder="Nama kategori">
						<strong class="text-red" style="display: none;">Kategori sudah digunakan</strong>
					</div>
					<div class="form-group">
						<label>Urutan</label>
						<input type="number" name="priority" class="form-control" required min="1" placeholder="Urutan (angka)">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn_submit">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="mdlEdit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Edit Kategori</h4>
			</div>
			<form id="formCategory" action="{{ url('console/article-categories') }}" method="post">
				<input type="hidden" name="id" value="">
				<div class="modal-body">
					@csrf
					<div class="form-group">
						<label>Title</label>
						<input type="text" name="title" class="form-control" required placeholder="Nama kategori">
						<strong class="text-red" style="display: none;">Kategori sudah digunakan</strong>
					</div>
					<div class="form-group">
						<label>Urutan</label>
						<input type="number" name="priority" class="form-control" required min="1" placeholder="Urutan (angka)">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn_submit">Update</button>
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
		$('#mdlEdit').on('shown.bs.modal', function(e){
			var mdl = $(e.relatedTarget);
			$("#mdlEdit input[name=id]").val(mdl.data('id'));
			$("#mdlEdit input[name=title]").val(mdl.data('title'));
			$("#mdlEdit input[name=priority]").val(mdl.data('priority'));
		}).on('hidden.bs.modal', function(){
			$("#mdlEdit input[name=title]").val('');
			$("#mdlEdit input[name=priority]").val('');
		})

		$('#mdlCreate .btn_submit').on('click',function(e) {
			$('#mdlCreate .btn_submit').attr('disabled',true).text('Loading...');
			$.post('/console/article-categories/ajax_cek_category', {title: $("#mdlCreate input[name=title]").val(), priority: $("#mdlCreate input[name=priority]").val()}, function(res){
				if (!res.success) {
					$('#mdlCreate .text-red').show();
					$('#mdlCreate .btn_submit').attr('disabled',false).text('Simpan');
				} else {
					$('#mdlCreate .text-red').hide();
					$('#mdlCreate form').submit();
				}
			});
		});

		$('#mdlEdit .btn_submit').on('click',function(e) {
			$('#mdlEdit .btn_submit').attr('disabled',true).text('Loading...');
			$.post('/console/article-categories/ajax_cek_category', {id:$("#mdlEdit input[name=id]").val(), title: $("#mdlEdit input[name=title]").val(), priority: $("#mdlEdit input[name=priority]").val()}, function(res){
				if (!res.success) {
					$('#mdlEdit .btn_submit').attr('disabled',false).text('Update');
					$('#mdlEdit .text-red').show();
				} else {
					$('#mdlEdit .text-red').hide();
					$('#mdlEdit form').submit();
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