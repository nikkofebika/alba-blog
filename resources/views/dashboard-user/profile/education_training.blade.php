@extends('dashboard.layouts.default')
@push('styles')
<link href="{{ asset('backend/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@endpush
@section('contentdashboard')
<div class="card border-0 shadow rounded">
	<div class="card-body">
		<div class="d-flex justify-content-end">
			<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">+ Tambah</button>
		</div>
		<div class="collapse my-3" id="collapseExample">
			<form method="POST" action="{{ url('dashboard') }}" autocomplete="off">
				@csrf
				<div class="row md-g-3 mb-2">
					<div class="col-md-3 col-sm-auto">
						<label class="col-form-label float-md-end">Institusi/Universitas <span class="text-danger">*</span></label>
					</div>
					<div class="col-md-9 col-sm-12">
						<input type="text" name="institusi" class="form-control" required>
					</div>
				</div>
				<div class="row md-g-3 mb-2">
					<div class="col-md-3 col-sm-auto">
						<label class="col-form-label float-md-end">Tanggal Lulus <span class="text-danger">*</span></label>
					</div>
					<div class="col-md-9 col-sm-12">
						<input type="text" name="institusi" class="form-control" required>
					</div>
				</div>
				<div class="row md-g-3 mb-2">
					<div class="col-md-3 col-sm-auto">
						<label class="col-form-label float-md-end">Kualifikasi <span class="text-danger">*</span></label>
					</div>
					<div class="col-md-9 col-sm-12">
						<select class="form-select">
							<option>- Pilih Kualifikasi -</option>
							<option>SMA/SMK</option>
							<option>Diploma (D3)</option>
							<option>Sarjana (S1)</option>
							<option>Magister (S2)</option>
							<option>Doktor (S3)</option>
							<option>Umum</option>
						</select>
					</div>
				</div>
				<div class="row md-g-3 mb-2">
					<div class="col-md-3 col-sm-auto">
						<label class="col-form-label float-md-end">Bidang Studi <span class="text-danger">*</span></label>
					</div>
					<div class="col-md-9 col-sm-12">
						<input type="text" name="institusi" class="form-control" required>
					</div>
				</div>
				<div class="row md-g-3 mb-2">
					<div class="col-md-3 col-sm-auto">
						<label class="col-form-label float-md-end">Jurusan</label>
					</div>
					<div class="col-md-9 col-sm-12">
						<input type="text" name="institusi" class="form-control" required>
					</div>
				</div>
				<div class="row md-g-3 mb-2">
					<div class="col-md-3 col-sm-auto">
						<label class="col-form-label float-md-end">Nilai Akhir / IPK</label>
					</div>
					<div class="col-md-9 col-sm-12">
						<input type="text" name="institusi" class="form-control" required>
					</div>
				</div>
				<button type="submit" class="btn btn-primary w-100"><i class="fa fa-save"></i> Simpan</button>
			</form>
		</div>

		<div class="px-2 mb-5">
			<h4>Education</h4>
			<div class="row shadow-sm rounded my-3 py-2" style="background-color: #F5F5F5">
				<div class="col-md-2 col-sm-12">
					Oktober 2021
				</div>
				<div class="col-md-10 col-sm-12">
					<h5 class="fw-bold mb-0">Universitas Indonesia</h5>
					<p class="mb-2">S1 Ilmu Komputer/Teknologi Informasi</p>
					<table style="font-size: 12px;">
						<tr>
							<th>Jurusan</th>
							<td>: Teknik Informatika</td>
						</tr>
						<tr>
							<th>IPK</th>
							<td>: 3.9</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="row shadow-sm rounded my-3 py-2" style="background-color: #F5F5F5">
				<div class="col-md-2 col-sm-12">
					Oktober 2021
				</div>
				<div class="col-md-10 col-sm-12">
					<h5 class="fw-bold mb-0">Universitas Indonesia</h5>
					<p class="mb-2">S1 Ilmu Komputer/Teknologi Informasi</p>
					<table style="font-size: 12px;">
						<tr>
							<th>Jurusan</th>
							<td>: Teknik Informatika</td>
						</tr>
						<tr>
							<th>IPK</th>
							<td>: 3.9</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="row shadow-sm rounded my-3" style="background-color: #F5F5F5">
				<div class="col-md-2 col-sm-12">
					Oktober 2021
				</div>
				<div class="col-md-10 col-sm-12">
					<h5 class="fw-bold mb-0">Universitas Indonesia</h5>
					<p class="mb-2">S1 Ilmu Komputer/Teknologi Informasi</p>
					<table style="font-size: 12px;">
						<tr>
							<th>Jurusan</th>
							<td>: Teknik Informatika</td>
						</tr>
						<tr>
							<th>IPK</th>
							<td>: 3.9</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<hr>
		<div class="px-2 mt-4">
			<h4>Training</h4>
			<div class="row shadow-sm rounded my-3" style="background-color: #F5F5F5">
				<div class="col-md-2 col-sm-12">
					Oktober 2021
				</div>
				<div class="col-md-10 col-sm-12">
					<h5 class="fw-bold mb-0">Universitas Indonesia</h5>
					<p class="mb-2">S1 Ilmu Komputer/Teknologi Informasi</p>
					<table style="font-size: 12px;">
						<tr>
							<th>Jurusan</th>
							<td>: Teknik Informatika</td>
						</tr>
						<tr>
							<th>IPK</th>
							<td>: 3.9</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="row shadow-sm rounded my-3" style="background-color: #F5F5F5">
				<div class="col-md-2 col-sm-12">
					Oktober 2021
				</div>
				<div class="col-md-10 col-sm-12">
					<h5 class="fw-bold mb-0">Universitas Indonesia</h5>
					<p class="mb-2">S1 Ilmu Komputer/Teknologi Informasi</p>
					<table style="font-size: 12px;">
						<tr>
							<th>Jurusan</th>
							<td>: Teknik Informatika</td>
						</tr>
						<tr>
							<th>IPK</th>
							<td>: 3.9</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="row shadow-sm rounded my-3" style="background-color: #F5F5F5">
				<div class="col-md-2 col-sm-12">
					Oktober 2021
				</div>
				<div class="col-md-10 col-sm-12">
					<h5 class="fw-bold mb-0">Universitas Indonesia</h5>
					<p class="mb-2">S1 Ilmu Komputer/Teknologi Informasi</p>
					<table style="font-size: 12px;">
						<tr>
							<th>Jurusan</th>
							<td>: Teknik Informatika</td>
						</tr>
						<tr>
							<th>IPK</th>
							<td>: 3.9</td>
						</tr>
					</table>
				</div>
			</div>
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
	});
</script>
@endpush