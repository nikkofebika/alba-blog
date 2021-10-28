@extends('layouts.default')
@push('styles')
<link href="{{ asset('backend/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container my-5">
	<div class="text-end">
		<a href="{{ url('dashboard/lost-item') }}" class="text-dark"><i class="fa fa-arrow-left"></i> Kembali</a>
	</div>
	<div class="card">
		<div class="card-body">
			<form action="{{ url('dashboard/lost-item/create') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div>
					<h5>Detail Barang</h5>
					<hr/>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group mb-3">
								<label>Nama Barang <span class="text-danger">*</span></label>
								<input type="text" name="name" class="form-control" placeholder="Nama Barang" required>
							</div>
							<div class="form-group mb-3">
								<label>Tanggal Kehilangan <span class="text-danger">*</span></label>
								<input type="date" name="lost_date" class="form-control" placeholder="Tanggal Kehilangan" required>
							</div>
							<div class="form-group mb-3">
								<label>Tag <span class="text-danger">*</span></label>
								<input type="text" name="tag" class="form-control" placeholder="Nama Barang" required>
							</div>
							<div class="form-group mb-3">
								<label>Detail Barang</label>
								<textarea name="description" class="form-control" required rows="5" placeholder="Deskripsikan barang anda..."></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group mb-3 @error('item_type_id') has-error @enderror">
								<label>Jenis Barang <span class="text-danger">*</span></label>
								<select name="item_type_id" class="form-control form-select select2" required>
									<option value="">- Pilih Jenis Barang -</option>
									@foreach($item_types as $it)
									<option value="{{ $it->id }}" {{ old('item_type_id') === $it->id ? "selected" : "" }}>{{ $it->name }}</option>
									@endForeach
								</select>
								@error('item_type_id')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3">
								<label>Model <span class="text-danger">*</span></label>
								<input type="text" name="model" class="form-control" placeholder="Model Barang" required>
							</div>
							<div class="form-group mb-3 @error('color') has-error @enderror">
								<label>Warna <span class="text-danger">*</span></label>
								<select name="color" class="form-select" required>
									<option value="">- Pilih Warna -</option>
									@foreach(getColorList() as $c)
									<option value="{{ $c }}">{{ $c }}</option>
									@endForeach
								</select>
								@error('color')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3">
								<label>Upload Gambar</label>
								<input type="file" name="images[]" class="form-control" multiple>
							</div>
						</div>
					</div>
				</div>
				<div>
					<h5>Lokasi Kehilangan</h5>
					<hr/>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group mb-3 @error('province_id') has-error @enderror">
								<label>Provinsi <span class="text-danger">*</span></label>
								<select name="province_id" class="form-control form-select select2" id="select-province" required>
									<option value="">- Pilih Provinsi -</option>
									@foreach($provinces as $p)
									<option value="{{ $p->id }}" {{ old('province_id') === $p->id ? "selected" : "" }}>{{ $p->name }}</option>
									@endForeach
								</select>
								@error('province_id')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3 @error('district_id') has-error @enderror">
								<label>Kecamatan <span class="text-danger">*</span></label>
								<select name="district_id" class="form-control form-select select2" id="select-district" disabled required>
									<option value="">- Pilih Kecamatan -</option>
								</select>
								@error('district_id')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3 @error('location_id') has-error @enderror">
								<label>Lokasi Kehilangan <span class="text-danger">*</span></label>
								<select name="location_id" class="form-control form-select select2" required>
									<option value="">- Pilih Lokasi -</option>
									@foreach($locations as $l)
									<option value="{{ $l->id }}" {{ old('location_id') === $l->id ? "selected" : "" }}>{{ $l->name }}</option>
									@endForeach
								</select>
								@error('location_id')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group mb-3 @error('regency_id') has-error @enderror">
								<label>Kota/Kabupaten <span class="text-danger">*</span></label>
								<select name="regency_id" class="form-control form-select select2" id="select-regency" disabled required>
									<option value="">- Pilih Kota/Kabupaten -</option>
								</select>
								@error('regency_id')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3 @error('village_id') has-error @enderror">
								<label>Kelurahan <span class="text-danger">*</span></label>
								<select name="village_id" class="form-control form-select select2" id="select-village" disabled required>
									<option value="">- Pilih Kelurahan -</option>
								</select>
								@error('village_id')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3">
								<label>Lokasi Spesifik</label>
								<textarea name="specific_location" class="form-control" required rows="5" placeholder="Detail lokasi kehilangan barang..."></textarea>
							</div>
						</div>
					</div>
				</div>
				<!-- <div>
					<h5>Informasi Pribadi</h5>
					<hr/>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group mb-3">
								<label for="name">{{ __('Name') }}</label>
								<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

								@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group mb-3">
								<label for="email">Email</label>
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group mb-3 @error('province_id') has-error @enderror">
								<label>Provinsi <span class="text-danger">*</span></label>
								<select name="province_id" class="form-control form-select select2" id="select-province" required>
									<option value="">- Pilih Provinsi -</option>
									@foreach($provinces as $p)
									<option value="{{ $p->id }}" {{ old('province_id') === $p->id ? "selected" : "" }}>{{ $p->name }}</option>
									@endForeach
								</select>
								@error('province_id')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3 @error('district_id') has-error @enderror">
								<label>Kecamatan</label>
								<select name="district_id" class="form-control form-select select2" id="select-district" disabled required>
									<option value="">- Pilih Kecamatan -</option>
								</select>
								@error('district_id')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group mb-3">
								<label for="phone">No. Handphone</label>
								<input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

								@error('phone')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group mb-3">
								<label for="password">{{ __('Password') }}</label>
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group mb-3 @error('regency_id') has-error @enderror">
								<label>Kota/Kabupaten <span class="text-danger">*</span></label>
								<select name="regency_id" class="form-control form-select select2" id="select-regency" disabled required>
									<option value="">- Pilih Kota/Kabupaten -</option>
								</select>
								@error('regency_id')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3 @error('village_id') has-error @enderror">
								<label>Kelurahan</label>
								<select name="village_id" class="form-control form-select select2" id="select-village" disabled>
									<option value="">- Pilih Kelurahan -</option>
								</select>
								@error('village_id')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="form-group mb-3">
							<label for="address">Alamat</label>
							<textarea class="form-control @error('address') is-invalid @enderror" name="address" required rows="3">{{ old('address') }}</textarea>
							@error('address')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>
				</div> -->
				<center><button type="submit" id="btn_submit" class="btn btn-primary text-white">Submit</button></center>
			</form>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
	$(document).ready(function($) {
		$('.select2').select2();
		$('form').on('submit', function(){
			$('#btn_submit').attr('disabled', true).html('Loading...');
		});
	});
</script>
@endpush