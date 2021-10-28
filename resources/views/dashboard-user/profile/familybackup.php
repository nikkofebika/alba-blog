@extends('dashboard.layouts.default')
@push('styles')
<link href="{{ asset('backend/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@endpush
@section('contentdashboard')
<div class="card border-0 shadow rounded">
	<div class="card-body" id="container_data">
		<div class="d-flex justify-content-end mb-3">
			<button class="btn btn-primary btn-sm" type="button" id="btnAdd">+ Tambah</button>
		</div>
		<div class="card shadow-sm rounded position-relative mb-3">
			<button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 btnDel"><i class="bx bx-trash"></i></button>
			<div class="card-body">
				<form method="POST" action="{{ url('dashboard') }}" autocomplete="off">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group mb-2">
								<label>Status <span class="text-danger">*</span></label>
								<select class="form-select">
									<option>- Pilih Status -</option>
									<option>Suami</option>
									<option selected>Istri</option>
									<option>Anak</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group mb-2">
								<label>Nama Lengkap <span class="text-danger">*</span></label>
								<input type="text" name="name" class="form-control" required value="Siti Winda" placeholder="Nama Lengkap">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group mb-2">
								<label>Tempat Lahir <span class="text-danger">*</span></label>
								<input type="text" name="name" class="form-control" required value="Jakarta" placeholder="Tempat Lahir">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group mb-2">
								<label>Tanggal Lahir <span class="text-danger">*</span></label>
								<input type="date" name="name" class="form-control" required value="1990-05-14" placeholder="Tanggal Lahir">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group mb-2">
								<label>Pendidikan/Pekerjaan <span class="text-danger">*</span></label>
								<select class="form-select">
									<option>- Pilih Pendidikan -</option>
									<option>Belum Sekolah</option>
									<option>Pelajar</option>
									<option>Mahasiswa</option>
									<option selected>Bekerja</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<div class="card shadow-sm rounded position-relative mb-3">
			<button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 btnDel"><i class="bx bx-trash"></i></button>
			<div class="card-body">
				<form method="POST" action="{{ url('dashboard') }}" autocomplete="off">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group mb-2">
								<label>Status <span class="text-danger">*</span></label>
								<select class="form-select">
									<option>- Pilih Status -</option>
									<option>Suami</option>
									<option>Istri</option>
									<option>Anak</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group mb-2">
								<label>Nama Lengkap <span class="text-danger">*</span></label>
								<input type="text" name="name" class="form-control" required value="" placeholder="Nama Lengkap">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group mb-2">
								<label>Tempat Lahir <span class="text-danger">*</span></label>
								<input type="text" name="name" class="form-control" required value="" placeholder="Tempat Lahir">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group mb-2">
								<label>Tanggal Lahir <span class="text-danger">*</span></label>
								<input type="date" name="name" class="form-control" required value="" placeholder="Tanggal Lahir">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group mb-2">
								<label>Pendidikan/Pekerjaan <span class="text-danger">*</span></label>
								<select class="form-select">
									<option>- Pilih Pendidikan -</option>
									<option>Belum Sekolah</option>
									<option>Pelajar</option>
									<option>Mahasiswa</option>
									<option>Bekerja</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
	<button type="submit" class="btn btn-primary w-100 mt-3"><i class="fa fa-save"></i> Update</button>
@endsection
@push('scripts')
<script src="{{ asset('backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
	$(document).ready(function($) {
		$('.select2').select2();
		$('body').on('click', '.btnDel', function(){
			$(this).parent().remove();
		});
		$('#btnAdd').on('click', function(){
			let html = '';
			html += `<div class="card shadow-sm rounded position-relative mb-3">`;
				html += `<button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 btnDel"><i class="bx bx-trash"></i></button>`;
				html += `<div class="card-body">`;
					html += `<form method="POST" action="{{ url('dashboard') }}" autocomplete="off">`;
						html += `<div class="row">`;
							html += `<div class="col-md-6">`;
								html += `<div class="form-group mb-2">`;
									html += `<label>Status <span class="text-danger">*</span></label>`;
									html += `<select class="form-select">`;
										html += `<option>- Pilih Status -</option>`;
										html += `<option>Suami</option>`;
										html += `<option>Istri</option>`;
										html += `<option>Anak</option>`;
									html += `</select>`;
								html += `</div>`;
							html += `</div>`;
							html += `<div class="col-md-6">`;
								html += `<div class="form-group mb-2">`;
									html += `<label>Nama Lengkap <span class="text-danger">*</span></label>`;
									html += `<input type="text" name="name" class="form-control" required value="" placeholder="Nama Lengkap">`;
								html += `</div>`;
							html += `</div>`;
						html += `</div>`;
						html += `<div class="row">`;
							html += `<div class="col-md-4">`;
								html += `<div class="form-group mb-2">`;
									html += `<label>Tempat Lahir <span class="text-danger">*</span></label>`;
									html += `<input type="text" name="name" class="form-control" required value="" placeholder="Tempat Lahir">`;
								html += `</div>`;
							html += `</div>`;
							html += `<div class="col-md-4">`;
								html += `<div class="form-group mb-2">`;
									html += `<label>Tanggal Lahir <span class="text-danger">*</span></label>`;
									html += `<input type="date" name="name" class="form-control" required value="" placeholder="Tanggal Lahir">`;
								html += `</div>`;
							html += `</div>`;
							html += `<div class="col-md-4">`;
								html += `<div class="form-group mb-2">`;
									html += `<label>Pendidikan/Pekerjaan <span class="text-danger">*</span></label>`;
									html += `<select class="form-select">`;
										html += `<option>- Pilih Pendidikan -</option>`;
										html += `<option>Belum Sekolah</option>`;
										html += `<option>Pelajar</option>`;
										html += `<option>Mahasiswa</option>`;
										html += `<option>Bekerja</option>`;
									html += `</select>`;
								html += `</div>`;
							html += `</div>`;
						html += `</div>`;
					html += `</form>`;
				html += `</div>`;
			html += `</div>`;
			$('#container_data').append(html);
		});
	});
</script>
@endpush