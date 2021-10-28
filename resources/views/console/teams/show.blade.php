@extends('console.layouts.master')
@section('content')
<div class="content-wrapper">
	<section class="content-header d-block">
		<h1 class="d-inline-block">Detail Data</h1>
		<a href="{{ url('console/company-policies') }}" class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-hover">
								<tr>
									<th>Judul</th>
									<td>: {{ $policy->title }}</td>
								</tr>
								<tr>
									<th>File</th>
									<td>: <a href="{{ asset($policy->file) }}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Download file</a></td>
								</tr>
								<tr>
									<th>Urutan</th>
									<td>: {{ $policy->priority }}</td>
								</tr>
								<tr>
									<th>Dibuat Oleh</th>
									<td>: {{ $policy->user->name }}</td>
								</tr>
								<tr>
									<th>Di Approve Oleh</th>
									<td>: <?php echo $policy->approved_by ? $policy->approvedby->name : '<span class="label label-warning">Belum di Approve</span>' ?></td>
								</tr>
								<tr>
									<th>Dibuat Pada</th>
									<td>: {{ date('d-M-Y H:i', strtotime($policy->created_at)) }}</td>
								</tr>
								<tr>
									<th>Deskripsi</th>
									<td>: <?php echo $policy->description ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endSection