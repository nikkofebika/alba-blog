@extends('console.layouts.master')
@section('content')
<div class="content-wrapper">
	<section class="content-header d-block">
		<h1 class="d-inline-block">Tambah Data</h1>
		<a href="{{ url('console/teams') }}" class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<form method="POST" action="{{ url('console/teams') }}" enctype="multipart/form-data">
						@csrf
						<div class="box-body">
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group @error('name') has-error @enderror">
										<label>Nama <span class="text-danger">*</span></label>
										<input type="text" name="name" class="form-control" required placeholder="Nama" value="{{ old('name') }}">
										@error('name')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
									<div class="form-group @error('position') has-error @enderror">
										<label>Jabatan <span class="text-danger">*</span></label>
										<input type="text" name="position" class="form-control" required placeholder="Jabatan" value="{{ old('position') }}">
										@error('position')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
									<div class="form-group @error('image') has-error @enderror">
										<label>Foto <span class="text-danger">*</span> <small class="text-warning">(Max 500kb | jpg,jpeg,png,svg)</small></label>
										<input type="file" name="image" class="form-control" required placeholder="Foto" value="{{ old('image') }}">
										@error('image')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
									<div class="form-group @error('priority') has-error @enderror">
										<label>Urutan <span class="text-danger">*</span></label>
										<input type="number" name="priority" class="form-control" required placeholder="Urutan" value="{{ old('priority') }}">
										@error('priority')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<label>Media Sosial</label>
									<div class="form-group @error('socmed.facebook') has-error @enderror">
										<input type="text" name="socmed[facebook]" class="form-control" value="{{ old('socmed.facebook') }}" placeholder="URL Facebook" />
										@error('socmed.facebook')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
									<div class="form-group @error('socmed.twitter') has-error @enderror">
										<input type="text" name="socmed[twitter]" class="form-control" value="{{ old('socmed.twitter') }}" placeholder="URL Twitter" />
										@error('socmed.twitter')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
									<div class="form-group @error('socmed.instagram') has-error @enderror">
										<input type="text" name="socmed[instagram]" class="form-control" value="{{ old('socmed.instagram') }}" placeholder="URL Instagram" />
										@error('socmed.instagram')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
									<div class="form-group @error('socmed.linkedin') has-error @enderror">
										<input type="text" name="socmed[linkedin]" class="form-control" value="{{ old('socmed.linkedin') }}" placeholder="URL Linkedin" />
										@error('socmed.linkedin')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
									<div class="form-group @error('socmed.youtube') has-error @enderror">
										<input type="text" name="socmed[youtube]" class="form-control" value="{{ old('socmed.youtube') }}" placeholder="URL Youtube" />
										@error('socmed.youtube')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary btn-block" id="btn_submit"><i class="fa fa-paper-plane"></i> Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
@endSection