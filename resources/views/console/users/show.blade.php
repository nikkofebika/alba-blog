@extends('console.layouts.master')
@section('content')
<div class="content-wrapper">
	<section class="content-header d-block">
		<h1 class="d-inline-block">User Profile</h1>
		<a href="{{ url('console/users') }}" class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-3">
				<div class="box box-primary">
					<div class="box-body box-profile">
						<a href="{{ asset($user->photo) }}" target="_blank"><img class="profile-user-img img-responsive" style="border: 0; border-radius: 10px;" src="{{ asset($user->photo) }}" alt="{{$user->name}}"></a>

						<h3 class="profile-username text-center">{{$user->name}}</h3>

						<p class="text-muted text-center">Software Engineer</p>

						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<strong><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp; Rp. 300.000</strong> <button class="btn btn-xs btn-warning pull-right" data-toggle="modal" data-target="#mdlTopup">Top Up</button>
							</li>
							<li class="list-group-item">
								<strong><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp; 085691977176</strong>
							</li>
							<li class="list-group-item">
								<strong><i class="fa fa-envelope"></i>&nbsp;&nbsp;&nbsp; nikkofe@gmail.com</strong>
							</li>
						</ul>
					</div>
				</div>
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Lainnya</h3>
					</div>
					<div class="box-body">
						<strong><i class="fa fa-home margin-r-5"></i> Alamat</strong>
						<p class="text-muted">
							The Bellezza Permata Hijau, Office Tower Lt. 26 Jalan Letjen Soepeno No. 34 Arteri Permata Hijau - Jakarta Selatan 12210.
						</p>
						<hr>
						<strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
						<p>
							<span class="label label-danger">UI Design</span>
							<span class="label label-success">Coding</span>
							<span class="label label-info">Javascript</span>
							<span class="label label-warning">PHP</span>
							<span class="label label-primary">Node.js</span>
						</p>
						<hr>
						<strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#education_training" data-toggle="tab">Education & Training</a></li>
						<li><a href="#family" data-toggle="tab">Family</a></li>
						<li><a href="#working_experience" data-toggle="tab">Working Experience</a></li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="education_training">
							<h3 class="mt-0 mb-2">Education</h3>
							<ul class="timeline timeline-inverse">
								<li class="time-label">
									<span class="bg-green">
										Oktober 2021
									</span>
								</li>
								<li>
									<i class="fa fa-graduation-cap bg-blue"></i>
									<div class="timeline-item">
										<h3 class="timeline-header">Universitas Indonesia</h3>
										<div class="timeline-body">
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
								</li>
								<li class="time-label">
									<span class="bg-green">
										Oktober 2021
									</span>
								</li>
								<li>
									<i class="fa fa-graduation-cap bg-blue"></i>
									<div class="timeline-item">
										<h3 class="timeline-header">Universitas Indonesia</h3>
										<div class="timeline-body">
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
								</li>
								<li class="time-label">
									<span class="bg-green">
										Oktober 2021
									</span>
								</li>
								<li>
									<i class="fa fa-graduation-cap bg-blue"></i>
									<div class="timeline-item">
										<h3 class="timeline-header">Universitas Indonesia</h3>
										<div class="timeline-body">
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
								</li>
							</ul>
							<hr>
							<h3 class="mt-0 mb-2">Training</h3>
							<ul class="timeline timeline-inverse">
								<li class="time-label">
									<span class="bg-red">
										Oktober 2021
									</span>
								</li>
								<li>
									<i class="fa fa-graduation-cap bg-blue"></i>
									<div class="timeline-item">
										<h3 class="timeline-header">Universitas Indonesia</h3>
										<div class="timeline-body">
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
								</li>
								<li class="time-label">
									<span class="bg-red">
										Oktober 2021
									</span>
								</li>
								<li>
									<i class="fa fa-graduation-cap bg-blue"></i>
									<div class="timeline-item">
										<h3 class="timeline-header">Universitas Indonesia</h3>
										<div class="timeline-body">
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
								</li>
								<li class="time-label">
									<span class="bg-red">
										Oktober 2021
									</span>
								</li>
								<li>
									<i class="fa fa-graduation-cap bg-blue"></i>
									<div class="timeline-item">
										<h3 class="timeline-header">Universitas Indonesia</h3>
										<div class="timeline-body">
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
								</li>
							</ul>
						</div>
						<div class="tab-pane" id="family">
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>Nama</th>
											<th>Status</th>
											<th>Tempat, Tgl Lahir</th>
											<th>Pendidikan/Pekerjaan</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Siti Winda</td>
											<td>Istri</td>
											<td>Jakarta, 14 Mei 1980</td>
											<td>Bekerja</td>
										</tr>
										<tr>
											<td>Adam Malik</td>
											<td>Anak</td>
											<td>Tangerang, 14 Mei 2001</td>
											<td>Mahasiswa</td>
										</tr>
										<tr>
											<td>Adam Malik</td>
											<td>Anak</td>
											<td>Tangerang, 14 Mei 2001</td>
											<td>Mahasiswa</td>
										</tr>
										<tr>
											<td>Adam Malik</td>
											<td>Anak</td>
											<td>Tangerang, 14 Mei 2001</td>
											<td>Mahasiswa</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="working_experience">
							<ul class="timeline timeline-inverse">
								<li class="time-label">
									<span class="bg-green">
										Oktober 2021
									</span>
								</li>
								<li>
									<i class="fa fa-briefcase bg-blue"></i>
									<div class="timeline-item">
										<h3 class="timeline-header">Web Developer</h3>
										<div class="timeline-body">
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
								</li>
								<li class="time-label">
									<span class="bg-green">
										Oktober 2021
									</span>
								</li>
								<li>
									<i class="fa fa-briefcase bg-blue"></i>
									<div class="timeline-item">
										<h3 class="timeline-header">Web Developer</h3>
										<div class="timeline-body">
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
								</li>
								<li class="time-label">
									<span class="bg-green">
										Oktober 2021
									</span>
								</li>
								<li>
									<i class="fa fa-briefcase bg-blue"></i>
									<div class="timeline-item">
										<h3 class="timeline-header">Web Developer</h3>
										<div class="timeline-body">
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
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

	</section>
</div>
<div class="modal fade" id="mdlTopup">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Top Up Saldo</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Nominal Saldo</label>
						<input type="number" name="topup" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button type="button" class="btn btn-primary">Top Up</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	@endSection