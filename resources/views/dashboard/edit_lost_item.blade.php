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
			<form action="{{ url('dashboard/lost-item/'.$item->id.'/edit') }}" method="POST" enctype="multipart/form-data">
				@csrf @method('PUT')
				<div>
					<h5>Detail Barang</h5>
					<hr/>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group mb-3 @error('name') has-error @enderror">
								<label>Nama Barang <span class="text-danger">*</span></label>
								<input type="text" name="name" class="form-control" placeholder="Nama Barang" required value="{{ $item->name }}">
								@error('name')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3 @error('lost_date') has-error @enderror">
								<label>Tanggal Kehilangan <span class="text-danger">*</span></label>
								<input type="date" name="lost_date" class="form-control" placeholder="Tanggal Kehilangan" required value="{{ date('Y-m-d', strtotime($item->lost_date)) }}">
								@error('lost_date')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3 @error('tag') has-error @enderror">
								<label>Tag <span class="text-danger">*</span></label>
								<input type="text" name="tag" class="form-control" placeholder="Nama Barang" required value="{{ $item->tag }}">
								@error('tag')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3 @error('description') has-error @enderror">
								<label>Detail Barang</label>
								<textarea name="description" class="form-control" required rows="5" placeholder="Deskripsikan barang yang anda temukan...">{{ $item->description }}</textarea>
								@error('description')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group mb-3 @error('item_type_id') has-error @enderror">
								<label>Jenis Barang <span class="text-danger">*</span></label>
								<select name="item_type_id" class="form-control form-select select2" required>
									<option value="">- Pilih Jenis Barang -</option>
									@foreach($item_types as $it)
									<option value="{{ $it->id }}" {{ $item->item_type_id == $it->id ? "selected" : "" }}>{{ $it->name }}</option>
									@endForeach
								</select>
								@error('item_type_id')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3 @error('model') has-error @enderror">
								<label>Model <span class="text-danger">*</span></label>
								<input type="text" name="model" class="form-control" placeholder="Model Barang" required value="{{ $item->model }}">
								@error('model')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3 @error('color') has-error @enderror">
								<label>Warna <span class="text-danger">*</span></label>
								<select name="color" class="form-select" required>
									<option value="">- Pilih Warna -</option>
									@foreach(getColorList() as $c)
									<option value="{{ $c }}" {{ $item->color == $c ? "selected" : "" }}>{{ $c }}</option>
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
							<div class="d-flex align-items-center gap-2">
								@foreach(json_decode($item->images) as $img)
								<a href="{{ asset($img) }}" title="{{ $img }}" target="_blank"><img src="{{ asset($img) }}" alt="{{ $img }}" width="100"></a>
								@endForeach
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
									<option value="{{ $p->id }}" {{ $item->province_id == $p->id ? "selected" : "" }}>{{ $p->name }}</option>
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
									<option value="{{ $l->id }}" {{ $item->location_id == $l->id ? "selected" : "" }}>{{ $l->name }}</option>
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
							<div class="form-group mb-3 @error('specific_location') has-error @enderror">
								<label>Lokasi Spesifik</label>
								<textarea name="specific_location" class="form-control" required rows="5" placeholder="Detail lokasi kehilangan barang...">{{ $item->specific_location }}</textarea>
								@error('specific_location')
								<span class="help-block">{{ $message }}</span>
								@enderror
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
				<center><button type="submit" class="btn btn-primary text-white">Submit</button></center>
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
		getRegencies(<?php echo $item->province_id ?>, <?php echo $item->regency_id ?>);
		getDistricts(<?php echo $item->regency_id ?>, <?php echo $item->district_id ?>);
		getVillages(<?php echo $item->district_id ?>, <?php echo $item->village_id ?>);
		$('form').on('submit', function(){
			$('#btn_submit').attr('disabled', true).html('Loading...');
		});
	});
</script>
@endpush