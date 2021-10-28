@extends('console.layouts.master')
@push('styles')
<link href="{{ asset('backend/bower_components/spectrum/dist/spectrum.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/bower_components/summernote/summernote.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="content-wrapper">
	<section class="content-header d-block">
		<h1 class="d-inline-block">Tambah Data</h1>
		<a href="{{ url('console/rooms') }}" class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<form method="POST" action="{{ url('console/rooms/'.$room->id) }}" enctype="multipart/form-data">
						@csrf @method('PUT')
						<div class="box-body">
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group @error('name') has-error @enderror">
										<label>Nama <span class="text-danger">*</span></label>
										<input type="text" name="name" class="form-control" required placeholder="Nama Ruangan" value="{{ $room->name }}">
										@error('name')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="form-group @error('color') has-error @enderror">
										<label>Warna <span class="text-danger">*</span></label>
										<input id="spectrum" type="text" name="color" class="form-control" required value="{{ $room->color }}" />
										@error('color')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group @error('image') has-error @enderror">
										<label>Gambar <small class="text-warning">(Upload untuk mengganti gambar | Max 500kb | jpg,jpeg,png,svg)</small></label>
										<input type="file" name="image" class="form-control">
										<a href="{{ asset($room->image) }}" target="_blank"><img src="{{ asset($room->image) }}" width="200" style="margin-top: 5px;"></a>
										@error('image')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="form-group @error('is_active') has-error @enderror">
										<label>Status <span class="text-danger">*</span></label>
										<select name="is_active" class="form-control" required>
											<option value="1" <?php echo $room->approved_by != null ? 'checked' : '' ?>>Aktif</option>
											<option value="0" <?php echo $room->approved_by == null ? 'checked' : '' ?>>Non Aktif</option>
											option
										</select>
										@error('is_active')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="form-group @error('description') has-error @enderror">
								<label>Deskripsi Ruangan <span class="text-danger">*</span></label>
								<textarea name="description" id="summernote" class="form-control" rows="5" required>{{ $room->description }}</textarea>
								@error('description')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary btn-block" id="btn_submit"><i class="fa fa-paper-plane"></i> Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
@endSection
@push('scripts')
<script src="{{ asset('backend/bower_components/spectrum/dist/spectrum.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/summernote/summernote.min.js') }}"></script>
<script>
	$(function () {
		$("#spectrum").spectrum({allowEmpty: true});
		$('#summernote').summernote({
			height: 500,
			placeholder: 'Tulis deskripsi disini...',
			toolbar: [
			['style', ['style', 'bold', 'italic', 'underline', 'clear']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']]
			]
		});
	});
</script>
@endpush