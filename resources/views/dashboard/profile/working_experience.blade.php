@extends('dashboard.layouts.default')
@push('styles')
<link href="{{ asset('backend/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('backend/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
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
						<div class="row md-g-3 mb-2">
							<div class="col-md-3 col-sm-auto">
								<label class="col-form-label float-md-end">Posisi <span class="text-danger">*</span></label>
							</div>
							<div class="col-md-9 col-sm-12">
								<input type="text" name="institusi" class="form-control" required>
							</div>
						</div>
						<div class="row md-g-3 mb-2">
							<div class="col-md-3 col-sm-auto">
								<label class="col-form-label float-md-end">Nama Perusahaan <span class="text-danger">*</span></label>
							</div>
							<div class="col-md-9 col-sm-12">
								<input type="text" name="institusi" class="form-control" required>
							</div>
						</div>
						<div class="row md-g-3 mb-2">
							<div class="col-md-3 col-sm-auto">
								<label class="col-form-label float-md-end">Lama Bekerja <span class="text-danger">*</span></label>
							</div>
							<div class="col-md-9 col-sm-12">
								<div class="input-group input-daterange">
									<input type="text" class="form-control bg-white" readonly value="">
									<span class="input-group-text">hingga</span>
									<input type="text" class="form-control bg-white" readonly value="">
								</div>
							</div>
						</div>
						<div class="row md-g-3 mb-2">
							<div class="col-md-3 col-sm-auto">
								<label class="col-form-label float-md-end">Spesialisasi <span class="text-danger">*</span></label>
							</div>
							<div class="col-md-9 col-sm-12">
								<input type="text" name="institusi" class="form-control" required>
							</div>
						</div>
						<div class="row md-g-3 mb-2">
							<div class="col-md-3 col-sm-auto">
								<label class="col-form-label float-md-end">Bidang Pekerjaan <span class="text-danger">*</span></label>
							</div>
							<div class="col-md-9 col-sm-12">
								<input type="text" name="institusi" class="form-control" required>
							</div>
						</div>
						<div class="row md-g-3 mb-2">
							<div class="col-md-3 col-sm-auto">
								<label class="col-form-label float-md-end">Industri <span class="text-danger">*</span></label>
							</div>
							<div class="col-md-9 col-sm-12">
								<input type="text" name="institusi" class="form-control" required>
							</div>
						</div>
						<div class="row md-g-3 mb-2">
							<div class="col-md-3 col-sm-auto">
								<label class="col-form-label float-md-end">Jabatan <span class="text-danger">*</span></label>
							</div>
							<div class="col-md-9 col-sm-12">
								<select class="form-select">
									<option>- Pilih Jabatan -</option>
									<option>CEO/GM/Direktur/Manajer Senior</option>
									<option>Manajer/Asisten Manajer</option>
									<option>Supervisor/Koordinator</option>
									<option>Pegawai (non-manajemen & non-supervisor)</option>
								</select>
							</div>
						</div>
						<div class="row md-g-3 mb-2">
							<div class="col-md-3 col-sm-auto">
								<label class="col-form-label float-md-end">Keterangan Kerja <span class="text-danger">*</span></label>
							</div>
							<div class="col-md-9 col-sm-12">
								<textarea class="form-control" rows="10" placeholder="Deskripsikan pekerjaan anda..."></textarea>
							</div>
						</div>
						<button type="submit" class="btn btn-primary w-100"><i class="fa fa-save"></i> Simpan</button>
					</form>
				</div>
			</div>
		</div>
		<div class="px-2 mb-5">
			<div class="row shadow-sm rounded my-3 py-2" style="background-color: #F5F5F5">
				<div class="col-md-2 col-sm-12">
					Oktober 2021
				</div>
				<div class="col-md-10 col-sm-12">
					<h5 class="fw-bold mb-0">Web Developer</h5>
					<p class="mb-2">PT. Triputra Energi Megatara</p>
					<table class="mb-2" style="font-size: 12px;">
						<tr>
							<th>Industri</th>
							<td>: Tambang</td>
						</tr>
						<tr>
							<th>Spesialisasi</th>
							<td>: Programer Web</td>
						</tr>
						<tr>
							<th>Bidang pekerjaan</th>
							<td>: Teknisi/Programer Perangkat Lunak</td>
						</tr>
						<tr>
							<th>Jabatan</th>
							<td>: Pegawai (non-manajemen & non-supervisor)</td>
						</tr>
					</table>
					<small>Triputra Energi Megatara (TEM) adalah perusahaan di bawah naungan Triputra Group yang berfokus pada trading energi. Sejak 2018, TEM mendapatkan kepercayaan dari ExxonMobil untuk mendistribusikan Mobil Diesel Oil ke Kalimantan dan wilayah Indonesia Timur lainnya.<br>Ke depannya, TEM akan meluaskan jangkauan ke seluruh Indonesia dan mengembangkan penjualan produk energi lain, tidak terkecuali produk energi terbarukan.</small>
				</div>
			</div>
			<div class="row shadow-sm rounded my-3 py-2" style="background-color: #F5F5F5">
				<div class="col-md-2 col-sm-12">
					Oktober 2021
				</div>
				<div class="col-md-10 col-sm-12">
					<h5 class="fw-bold mb-0">Web Developer</h5>
					<p class="mb-2">PT. Triputra Energi Megatara</p>
					<table class="mb-2" style="font-size: 12px;">
						<tr>
							<th>Industri</th>
							<td>: Tambang</td>
						</tr>
						<tr>
							<th>Spesialisasi</th>
							<td>: Programer Web</td>
						</tr>
						<tr>
							<th>Bidang pekerjaan</th>
							<td>: Teknisi/Programer Perangkat Lunak</td>
						</tr>
						<tr>
							<th>Jabatan</th>
							<td>: Pegawai (non-manajemen & non-supervisor)</td>
						</tr>
					</table>
					<small>Triputra Energi Megatara (TEM) adalah perusahaan di bawah naungan Triputra Group yang berfokus pada trading energi. Sejak 2018, TEM mendapatkan kepercayaan dari ExxonMobil untuk mendistribusikan Mobil Diesel Oil ke Kalimantan dan wilayah Indonesia Timur lainnya.<br>Ke depannya, TEM akan meluaskan jangkauan ke seluruh Indonesia dan mengembangkan penjualan produk energi lain, tidak terkecuali produk energi terbarukan.</small>
				</div>
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
<script src="{{ asset('backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script>
	$(document).ready(function($) {
		$('.select2').select2();
		$('.input-daterange input').each(function() {
			$(this).datepicker({
				format: "mm-yyyy",
				startView: "months", 
				minViewMode: "months"
			});
		});
		$('.btnDel').on('click', '', function(){
			if (confirm('Hapus data?')) {
				$(this).parent().parent().remove();
			}
		});
	});
</script>
@endpush