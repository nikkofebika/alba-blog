@extends('dashboard.layouts.default')
@push('styles')
<link href="{{ asset('backend/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@endpush
@section('contentdashboard')
<div class="card border-0 shadow rounded">
	<div class="card-body">
		<div class="d-flex justify-content-end">
			<button class="btn btn-primary btn-sm mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">+ Tambah</button>
		</div>
		<div class="collapse mb-3" id="collapseExample">
			<div class="card shadow-sm rounded mb-3">
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
						<button type="submit" class="btn btn-primary float-end mt-3"><i class="bx bx-save"></i> Simpan</button>
					</form>
				</div>
			</div>
		</div>
		<div class="card shadow-sm rounded position-relative mb-3">
			<div class="position-absolute top-0 end-0">
				<button type="button" class="btn btn-warning btn-sm" title="Hapus" data-bs-toggle="modal" data-bs-target="#mdlEdit"><i class="bx bx-edit"></i></button>
				<button type="button" class="btn btn-danger btn-sm btnDel" title="Edit"><i class="bx bx-trash"></i></button>
			</div>
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
								<input type="date" name="name" class="form-control" required value="1980-05-14" placeholder="Tanggal Lahir">
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
			<div class="position-absolute top-0 end-0">
				<button type="button" class="btn btn-warning btn-sm" title="Hapus" data-bs-toggle="modal" data-bs-target="#mdlEdit"><i class="bx bx-edit"></i></button>
				<button type="button" class="btn btn-danger btn-sm btnDel" title="Edit"><i class="bx bx-trash"></i></button>
			</div>
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
									<option selected>Anak</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group mb-2">
								<label>Nama Lengkap <span class="text-danger">*</span></label>
								<input type="text" name="name" class="form-control" required value="Adam Malik" placeholder="Nama Lengkap">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group mb-2">
								<label>Tempat Lahir <span class="text-danger">*</span></label>
								<input type="text" name="name" class="form-control" required value="Tangerang" placeholder="Tempat Lahir">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group mb-2">
								<label>Tanggal Lahir <span class="text-danger">*</span></label>
								<input type="date" name="name" class="form-control" required value="2001-05-14" placeholder="Tanggal Lahir">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group mb-2">
								<label>Pendidikan/Pekerjaan <span class="text-danger">*</span></label>
								<select class="form-select">
									<option>- Pilih Pendidikan -</option>
									<option>Belum Sekolah</option>
									<option>Pelajar</option>
									<option selected>Mahasiswa</option>
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
<div class="modal fade" id="mdlEdit" tabindex="-1" aria-labelledby="mdlEditLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="{{ url('dashboard') }}" autocomplete="off">
				<div class="modal-body">
					@csrf
					<div class="form-group mb-2">
						<label>Status <span class="text-danger">*</span></label>
						<select class="form-select">
							<option>- Pilih Status -</option>
							<option>Suami</option>
							<option selected>Istri</option>
							<option>Anak</option>
						</select>
					</div>
					<div class="form-group mb-2">
						<label>Nama Lengkap <span class="text-danger">*</span></label>
						<input type="text" name="name" class="form-control" required value="Siti Winda" placeholder="Nama Lengkap">
					</div>
					<div class="form-group mb-2">
						<label>Tempat Lahir <span class="text-danger">*</span></label>
						<input type="text" name="name" class="form-control" required value="Jakarta" placeholder="Tempat Lahir">
					</div>
					<div class="form-group mb-2">
						<label>Tanggal Lahir <span class="text-danger">*</span></label>
						<input type="date" name="name" class="form-control" required value="1990-05-14" placeholder="Tanggal Lahir">
					</div>
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
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
					<button type="button" class="btn btn-primary">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
	$(document).ready(function($) {
		$('.select2').select2();
		$('.btnDel').on('click', '', function(){
			if (confirm('Hapus data?')) {
				$(this).parent().parent().remove();
			}
		});
	});
</script>
@endpush