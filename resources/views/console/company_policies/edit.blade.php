@extends('console.layouts.master')
@push('styles')
<link href="{{ asset('backend/bower_components/summernote/summernote.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/bower_components/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="content-wrapper">
	<section class="content-header d-block">
		<h1 class="d-inline-block">Edit Data</h1>
		<a href="{{ url('console/company-policies') }}" class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<form method="POST" action="{{ url('console/company-policies/'.$policy->id) }}" enctype="multipart/form-data">
						@csrf @method('PUT')
						<div class="box-body">
							<div class="form-group @error('title') has-error @enderror">
								<label>Judul <span class="text-danger">*</span></label>
								<input type="text" name="title" class="form-control" required placeholder="Judul Policy" value="{{ $policy->title }}">
								@error('title')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group @error('file') has-error @enderror">
										<label>File <small class="text-warning">(Isi/hapus untuk mengganti/mengosongkan file | Max 2mb | jpg,jpeg,png,svg,pdf,doc,docx,xls,xlsx)</small></label>
										<input type="file" name="file" class="form-control">
										<?php if ($policy->file != null && $policy->file != ''): ?>
											<div class="thumbnail position-relative d-inline-block mt-3 text-center p-5">
												<input type="hidden" name="existing_file" value="{{ $policy->file }}">
												<button class="btn btn-danger btn-xs position-absolute top-0 end-0" id="btnDelParent">Hapus</button>
												<a href="{{ asset($policy->file) }}" target="_blank" title="Download/preview file">
													<i class="fa fa-download"></i>
													<p>DOWNLOAD FILE</p>
												</a>
											</div>
										<?php endif ?>
										@error('file')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="form-group @error('priority') has-error @enderror">
										<label>Urutan <span class="text-danger">*</span></label>
										<input type="number" name="priority" min="0" class="form-control" required value="{{ $policy->priority }}" placeholder="Urutan tampil (angka)" />
										@error('priority')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="form-group @error('description') has-error @enderror">
								<label>Description <span class="text-danger">*</span></label>
								<textarea name="description" id="summernote" class="form-control" rows="5" required>{{ $policy->description }}</textarea>
								@error('description')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary btn-block" id="btn_submit"><i class="fa fa-paper-plane"></i> Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
@endSection
@push('scripts')
<script src="{{ asset('backend/bower_components/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script>
	$(function () {
		$('#btnDelParent').on('click', function(){
			$(this).parent().remove();
		});
		$('#datetimepicker').datetimepicker({
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
		});
		$('#summernote').summernote({
			height: 500,
			placeholder: 'Tulis deskripsi disini...',
			toolbar: [
			[ 'style', [ 'style' ] ],
			[ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
			[ 'fontsize', [ 'fontsize' ] ],
			[ 'color', [ 'color' ] ],
			[ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
			[ 'table', [ 'table' ] ],
			[ 'insert', [ 'link'] ],
			[ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
			]
		});
	});
</script>
@endpush