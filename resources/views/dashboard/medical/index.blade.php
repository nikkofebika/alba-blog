@extends('dashboard.layouts.default')
@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
<link href="{{ asset('backend/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
<style type="text/css">
	.navbar a{
		text-decoration: none;
	}
	button.btn {
		padding-right: 4px !important;
		padding-left: 4px !important;
		padding-top: 2px !important;
		padding-bottom: 2px !important;
	}
	.coupon {
		border: 3px dotted #bbb;
		border-radius: 7px;
	}
</style>
@endpush
@section('contentdashboard')
<div class="card border-0 shadow rounded">
	<div class="card-body">
		<div class="d-flex justify-content-between">
			<p class="fw-bold coupon px-3 py-1">Sisa Saldo : Rp. 300.000</p>
			<button class="btn btn-primary btn-sm mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">+ Tambah</button>
		</div>
		<div class="collapse mb-3" id="collapseExample">
			<div class="card shadow-sm rounded mb-3">
				<div class="card-body">
					<form method="POST" action="{{ url('dashboard') }}" autocomplete="off">
						@csrf
						<div class="form-group mb-2">
							<label>Keterangan <span class="text-danger">*</span></label>
							<input type="text" name="name" class="form-control" required value="" placeholder="Keterangan medis">
						</div>
						<div class="form-group mb-2">
							<label>Total Biaya <span class="text-danger">*</span></label>
							<input type="text" name="name" class="form-control" required value="" placeholder="Total Biaya">
						</div>
						<div class="form-group mb-2">
							<label>Bukti Transaksi <span class="text-danger">*</span></label>
							<input type="file" name="name" class="form-control" required value="">
						</div>
						<button type="submit" class="btn btn-primary float-end mt-3"><i class="bx bx-upload"></i> Upload</button>
					</form>
				</div>
			</div>
		</div>
		<div class="table-responsive">
			<table id="datatable" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Keterangan</th>
						<th>Bukti</th>
						<th>Total</th>
						<th>Status</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Rapid Test PCR</td>
						<td><a href="{{ asset('images/medical/bukti_medical.jpg') }}" target="_blank">Tampilkan</a></td>
						<td>Rp. 500.000</td>
						<th><span class="badge bg-success">Approved</span></th>
						<td>
						</td>
					</tr>
					<tr>
						<td>2</td>
						<td>Medical Check Up</td>
						<td><a href="{{ asset('images/medical/bukti_medical.jpg') }}" target="_blank">Tampilkan</a></td>
						<td>Rp. 180.000</td>
						<th><span class="badge bg-danger">Rejected</span></th>
						<td>
							<button class="btn btn-warning btn-sm" data-id="" data-title="" data-toggle="modal" data-target="#mdlDetail"><i class="bx bx-edit"></i></button>
							<form method="POST" onsubmit="return confirm('Hapus data ?')" action="" class="d-inline">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i class="bx bx-trash"></i></button></form>
						</td>
					</tr>
					<tr>
						<td>3</td>
						<td>Beli Vitamin</td>
						<td><a href="{{ asset('images/medical/bukti_medical.jpg') }}" target="_blank">Tampilkan</a></td>
						<td>Rp. 350.000</td>
						<th><span class="badge bg-secondary">Processed</span></th>
						<td>
							<button class="btn btn-warning btn-sm" data-id="" data-title="" data-toggle="modal" data-target="#mdlDetail"><i class="bx bx-edit"></i></button>
							<form method="POST" onsubmit="return confirm('Hapus data ?')" action="" class="d-inline">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i class="bx bx-trash"></i></button></form>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script>
	$(document).ready(function($) {
		$('#datatable').DataTable();
		// $('.select2').select2();
		
	});
</script>
@endpush