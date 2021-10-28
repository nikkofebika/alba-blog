@extends('console.layouts.master')
@push('styles')
<link href="{{ asset('backend/bower_components/summernote/summernote.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/bower_components/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="content-wrapper">
	<section class="content-header d-block">
		<h1 class="d-inline-block">Edit Data</h1>
		<a href="{{ url('console/posts') }}" class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<form method="POST" action="{{ url('console/posts/'.$post->id) }}" enctype="multipart/form-data">
						@csrf @method('PUT')
						<div class="box-body">
							<div class="form-group @error('title') has-error @enderror">
								<label>Judul <span class="text-danger">*</span></label>
								<input type="text" name="title" class="form-control" required placeholder="Judul" value="{{ $post->title }}">
								@error('title')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group @error('image') has-error @enderror">
										<label>Gambar <small class="text-warning">(Upload ulang untuk mengganti gambar | Max 500kb | jpg,jpeg,png,svg)</small></label>
										<input type="file" name="image" class="form-control" value="{{ old('image') }}">
										<a href="{{ asset($post->image) }}" target="_blank"><img src="{{ asset($post->image) }}" width="100" class="mt-3"></a>
										@error('image')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="form-group @error('published_at') has-error @enderror">
										<label>Waktu Tayang <span class="text-danger">*</span></label>
										<input type="text" name="published_at" class="form-control" id="datetimepicker" required value="{{ date('Y-m-d H:i', strtotime($post->published_at)) }}" readonly/>
										@error('published_at')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group @error('category_id') has-error @enderror">
										<label>Kategori <span class="text-danger">*</span></label>
										<select name="category_id" class="form-control">
											<option>- Pilih Kategori -</option>
											@foreach($categories as $c)
											<option value="{{ $c->id }}" <?php echo $post->category_id == $c->id ? 'selected' : '' ?>>{{ $c->title }}</option>
											@endforeach
										</select>
										@error('category_id')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="form-group @error('is_slider') has-error @enderror">
										<label>Slider ? <span class="text-danger">*</span></label>
										<select name="is_slider" class="form-control">
											<option value="0" <?php echo $post->is_slider == 0 ? 'selected' : '' ?>>Tidak</option>
											<option value="1" <?php echo $post->is_slider == 1 ? 'selected' : '' ?>>Ya</option>
										</select>
										@error('is_slider')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="form-group @error('description') has-error @enderror">
								<label>Description <span class="text-danger">*</span></label>
								<textarea name="description" id="summernote" class="form-control" rows="5" required>{{ $post->description }}</textarea>
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
<script src="{{ asset('backend/bower_components/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script>
	$(function () {
		$('#datetimepicker').datetimepicker({
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
		});
		$('#summernote').summernote({
			height: 500,
			placeholder: 'Tulis deskripsi disini...'
		});
		x = document.getElementById("password");
		$('#btnShowHide').click(function(){
			if (x.type === "password") {
				$(this).children().removeClass('fa-eye').addClass('fa-eye-slash')
				x.type = "text";
			} else {
				x.type = "password";
				$(this).children().removeClass('fa-eye-slash').addClass('fa-eye');
			}
		})
	});
</script>
@endpush