@extends('console.layouts.master')
@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/bower_components/fullcalendar/dist/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/bower_components/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">
<link href="{{ asset('backend/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
<link href="https://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" rel="stylesheet">
<link href="{{ asset('backend/bower_components/timepicker/timepicker.css') }}" rel="stylesheet">
<link href="{{ asset('backend/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
<style type="text/css">
	.select2-container{width: 100% !important;}
	.btn-group button {
		background: white;
	}

	.btn-group button.btn-approved.active {
		background: #00A65A !important;
		color: white !important;
	}
	.btn-group button.btn-approved.active:hover {
		background: #00A65A !important;
		color: white !important;
	}

	.btn-group button.btn-waiting.active {
		background: #E08E0B !important;
		color: white !important;
	}
	.btn-group button.btn-waiting.active:hover, .btn-group button.btn-waiting:hover {
		background: #E08E0B !important;
		color: white !important;
	}

	.btn-group button.btn-rejected.active {
		background: #D73925 !important;
		color: white !important;
	}
	.btn-group button.btn-rejected.active:hover, .btn-group button.btn-rejected:hover {
		background: #D73925 !important;
		color: white !important;
	}
</style>
@endpush
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>{{$page_title}}</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#table_tab" data-toggle="tab" aria-expanded="true">Tabel</a></li>
						<li class=""><a href="#calendar_tab" data-toggle="tab" aria-expanded="false">Kalender</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="table_tab">
							<?php if(session('notification')){echo session('notification');} ?>
							<div class="text-right">
								<button id="btn_add_schedule" title="Tambah Data" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</button>
							</div>
							<div class="table-responsive mt-4">
								<table id="datatable" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>No</th>
											<th>Subjek</th>
											<th>Ruangan</th>
											<th>User</th>
											<th>Tanggal</th>
											<th>Mulai - Selesai</th>
											<th>Status</th>
											<th></th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="calendar_tab">
							<div class="row">
								<div class="col-md-12">
									<div class="box box-primary">
										<div class="box-body">
											<div>
												@foreach($rooms as $r)
												<small class="label" style="background: {{ $r->color }}">{{ $r->name }}</small>
												@endForeach
											</div>
											<div id="calendar"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<div class="modal fade" id="mdlAddSchedule">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Booking Ruangan</h4>
			</div>
			<form method="POST" action="" autocomplete="off" id="formCreateSchedule">
				@csrf
				<div class="modal-body">
					<div class="form-group @error('title') has-error @enderror">
						<label>Subjek <span class="text-danger">*</span></label>
						<input type="text" name="title" class="form-control" required placeholder="Nama event" value="">
						@error('title')
						<span class="help-block">{{ $message }}</span>
						@enderror
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="form-group @error('user_id') has-error @enderror">
								<label class="d-block">User <span class="text-danger">*</span></label>
								<select name="user_id" class="form-control select2" required>
									<option value="">- Pilih User -</option>
									@foreach ($users as $u)
									<option value="{{ $u->id }}">{{ $u->name }}</option>
									@endForeach
								</select>
								@error('user_id')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group @error('room_id') has-error @enderror">
								<label class="d-block">Ruangan <span class="text-danger">*</span></label>
								<select name="room_id" id="room_id_add" class="form-control select2" required>
									<option value="">- Pilih Ruangan -</option>
									@foreach ($rooms as $r)
									<option value="{{ $r->id }}">{{ $r->name }}</option>
									@endForeach
								</select>
								@error('room_id')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group @error('date') has-error @enderror">
								<label>Tanggal <span class="text-danger">*</span></label>
								<input type="text" name="date" class="form-control" value="" required id="myDatepicker" readonly required style="cursor: no-drop;">
								@error('date')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<label>Daftar booking :</label>
							<div id="container_schedules_alert" class="alert alert-warning"><i class="fa fa-info-circle"></i> Pilih ruangan dan tanggal untuk melihat daftar booking.</div>
							<div id="container_schedules"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="form-group @error('start_hour') has-error @enderror">
								<label>Jam Mulai <span class="text-danger">*</span></label>
								<input type="text" name="start_hour" class="form-control start_hour" required value="">
								@error('start_hour')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group @error('end_hour') has-error @enderror">
								<label>Jam Selesai <span class="text-danger">*</span></label>
								<input type="text" name="end_hour" class="form-control end_hour" required value="">
								@error('end_hour')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="mdlEditSchedule">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Booking Ruangan</h4>
			</div>
			<form method="POST" action="" autocomplete="off" id="formEditSchedule">
				@csrf
				<input type="hidden" id="edit_schedule_id" name="id" value="">
				<div class="modal-body">
					<div class="form-group">
						<label>Subjek <span class="text-danger">*</span></label>
						<input type="text" name="title" class="form-control" required placeholder="Nama event" value="">
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label class="d-block">User <span class="text-danger">*</span></label>
								<select name="user_id" class="form-control select2" required>
									<option value="">- Pilih User -</option>
									@foreach ($users as $u)
									<option value="{{ $u->id }}">{{ $u->name }}</option>
									@endForeach
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label class="d-block">Ruangan <span class="text-danger">*</span></label>
								<select name="room_id" id="room_id_edit" class="form-control select2" required>
									<option value="">- Pilih Ruangan -</option>
									@foreach ($rooms as $r)
									<option value="{{ $r->id }}">{{ $r->name }}</option>
									@endForeach
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Tanggal <span class="text-danger">*</span></label>
								<input type="text" name="date" class="form-control" value="" required id="myDatepicker_edit" readonly required style="cursor: no-drop;">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<label>Daftar booking :</label>
							<div id="container_schedules_alert_edit" class="alert alert-warning"><i class="fa fa-info-circle"></i> Pilih ruangan dan tanggal untuk melihat daftar booking.</div>
							<div id="container_schedules_edit"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Jam Mulai <span class="text-danger">*</span></label>
								<input type="text" name="start_hour" class="form-control start_hour" required value="">
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Jam Selesai <span class="text-danger">*</span></label>
								<input type="text" name="end_hour" class="form-control end_hour" required value="">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button type="button" class="btn btn-danger" id="btn_del_schedule">Hapus</button>
					<button type="submit" class="btn btn-primary" id="btn_update_schedule">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="mdlApprove">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="formCategory" action="{{ url('console/article-categories') }}" method="post">
				<div class="modal-body">
					@csrf
					<div class="form-group">
						<label>Pilih Status</label>
						<select name="status" class="form-control">
							<option value="0">Waiting</option>
							<option value="1">Approved</option>
							<option value="2">Rejected</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button type="button" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endSection
@push('scripts')
<script src="{{ asset('backend/bower_components/moment/moment.js') }}"></script>
<script src="{{ asset('backend/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/timepicker/timepicker.js') }}"></script>
<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
<script type="text/javascript">
	$(function () {
		var table = $('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('console.rooms.booking_schedule_list') }}",
			columns: [
			{data: 'id', sortable: 'false',
			render: function (data, type, row, meta) {
				return meta.row + meta.settings._iDisplayStart + 1;
			}},
			{data: 'title', name: 'title'},
			{data: 'room_id', name: 'room_id'},
			{data: 'user_id', name: 'user_id'},
			{data: 'start_date', name: 'start_date'},
			{data: 'start_hour', name: 'start_hour'},
			{data: 'is_active', name: 'is_active'},
			{
				data: 'action', 
				name: 'action',
				orderable: false, 
				searchable: false
			},
			]
		});

		function ajax_load_schedules(scheduleId = null){
			return new Promise(function(resolve, reject) {
				if (scheduleId != null) {
					$.get('{{ url("console/rooms/ajax_load_schedules") }}/' + scheduleId, function(res){
						resolve(res)
					})
				} else {
					$.get('{{ url("console/rooms/ajax_load_schedules") }}', function(res){
						resolve(res)
					})
				}
			})
		}

		var initialEvent = null;
		var addFromTable = false;
		var editFromTable = false;
		var todayDate = new Date('<?php echo date('Y-m-d') ?>');
		$('#calendar').fullCalendar({
			header    : {
				left  : 'prev,next today',
				center: 'title',
				right : 'month,agendaWeek,agendaDay,list'
			},
			buttonText: {
				today: 'today',
				month: 'month',
				week : 'week',
				day  : 'day'
			},
			allDaySlot: false,
			events : async function(start, end, timezone, callback) {
				var evnts = await ajax_load_schedules();
				callback(evnts.data);
			},
			dayRender: function(date, cell){
				var end = new Date();
				end.setDate(todayDate.getDate()-1);
				if(date < end) {
					cell.css("background-color", "#E9ECEF");
				}
			},
			editable  : true,
			droppable : true,
			drop: function(date) {
				alert('drop');
			},
			eventDrop : async function (event, delta, revertFunc) {
				if(event.start._d >= todayDate) {
					var moveScheduleDrop = await ajax_move_schedule({id: event.id, start_time: event.start.format(), end_time: event.end.format()});
					if (!moveScheduleDrop.success) {
						revertFunc();
						toastr.error(moveScheduleDrop.message);
					} else {
						toastr.success(moveScheduleDrop.message);
						table.ajax.reload();
					}
				} else {
					revertFunc();
					toastr.warning('Jadwal tidak dapat dipindahkan pada hari kemarin!');
				}
			},
			eventResize: async function(event, delta, revertFunc) {
				var moveScheduleResize = await ajax_move_schedule({id: event.id, start_time: event.start.format(), end_time: event.end.format()});
				if (!moveScheduleResize.success) {
					revertFunc();
					toastr.error(moveScheduleResize.message);
				} else {
					toastr.success(moveScheduleResize.message);
					table.ajax.reload();
				}

			},
			dayClick: function(event) {
				if(event._d >= todayDate) {
					$('#mdlAddSchedule').modal('show').on('shown.bs.modal', function(){
						$("#formCreateSchedule input[name=date]").val(event.format());
					});
				} else {
					toastr.warning('Anda hanya dapat membuat jadwal minimal hari ini!');
				}
			},
			eventClick: async function(event, view) {
				var scheduleClick = await ajax_load_schedules(event.id);
				$('#mdlEditSchedule').modal('show').on('shown.bs.modal', function(){
					if(event.start._d >= todayDate) {
						$('#btn_update_schedule').show();
					} else {
						$('#btn_update_schedule').hide();
					}
					$("#formEditSchedule input[name=id]").val(scheduleClick.data.id);
					$("#formEditSchedule input[name=title]").val(scheduleClick.data.title);
					$("#formEditSchedule select[name=user_id]").val(scheduleClick.data.user_id).change();
					$("#formEditSchedule select[name=room_id]").val(scheduleClick.data.room_id).change();
					$("#formEditSchedule input[name=date]").val(scheduleClick.data.start_date);
					$("#formEditSchedule input[name=start_hour]").val(scheduleClick.data.start_hour);
					$("#formEditSchedule input[name=end_hour]").val(scheduleClick.data.end_hour);
				});
				initialEvent = event;
			}
		});
		$('.select2').select2();
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

		function ajax_move_schedule(data){
			return new Promise(function(resolve, reject){
				$.post('{{ url("console/rooms/ajax_move_schedule") }}', data, function(res){
					resolve(res);
				});
			});
		}

		function renderNewSchedule(data){
			$('#calendar').fullCalendar('renderEvent', data);
		}

		$('#formCreateSchedule').on('submit', function(e){
			e.preventDefault();
			var dataForm = $(this).serializeArray();
			$.post('{{ url("console/rooms/ajax_create_booking_schedules") }}', dataForm, function(res){
				if (res.success) {
					addFromTable = false;
					renderNewSchedule(res.data);
					table.ajax.reload();
					$('#mdlAddSchedule').modal('hide');
					toastr.success(res.message);
				} else {
					toastr.error(res.message);
				}
			});
		});

		$('#mdlAddSchedule').on('hidden.bs.modal', function(){
			$("#formCreateSchedule input[name=title]").val('');
			$("#formCreateSchedule select[name=user_id]").val('').change();
			$("#formCreateSchedule select[name=room_id]").val('').change();
			$("#formCreateSchedule input[name=date]").val('');
			$("#formCreateSchedule input[name=start_hour]").val('');
			$("#formCreateSchedule input[name=end_hour]").val('');
		});

		$('#formEditSchedule').on('submit', function(e){
			e.preventDefault();
			var dataForm = $(this).serializeArray();
			$.post('{{ url("console/rooms/ajax_create_booking_schedules") }}', dataForm, function(res){
				if (res.success) {
					$('#mdlEditSchedule').modal('hide');
					toastr.success(res.message);
					table.ajax.reload();
					if (editFromTable) {
						editFromTable = false;
						$('#calendar').fullCalendar('refetchEvents');
					} else {
						initialEvent.title = res.data.title;
						initialEvent.start._i = res.data.start;
						initialEvent.end._i = res.data.end;
						initialEvent.backgroundColor = res.data.backgroundColor;
						initialEvent.borderColor = res.data.borderColor;
						$('#calendar').fullCalendar('updateEvent', initialEvent);
						initialEvent = null;
					}
				} else {
					toastr.error(res.message);
				}
			});
		});

		$('#mdlEditSchedule').on('hidden.bs.modal', function(){
			$("#formEditSchedule input[name=id]").val('');
			$("#formEditSchedule input[name=title]").val('');
			$("#formEditSchedule select[name=user_id]").val('').change();
			$("#formEditSchedule select[name=room_id]").val('').change();
			$("#formEditSchedule input[name=date]").val('');
			$("#formEditSchedule input[name=start_hour]").val('');
			$("#formEditSchedule input[name=end_hour]").val('');
		});

		function ajax_get_today_schedules(roomId, date, scheduleId = null){
			if (scheduleId != null) {
				$.get('{{ url("console/rooms/ajax_get_today_schedules") }}/' + roomId + '/' + date + scheduleId, function (res){
					$('#container_schedules_alert_edit').hide();
					$('#container_schedules_edit').html(res);
				});
			} else {
				$.get('{{ url("console/rooms/ajax_get_today_schedules") }}/' + roomId + '/' + date, function (res){
					$('#container_schedules_alert').hide();
					$('#container_schedules').html(res);
				});
			}
		}

		function ajax_delete_booking_schedules(id){
			return new Promise(function(resolve, reject){
				$.post('{{ url("console/rooms/ajax_delete_booking_schedules") }}', {id: id}, function(res){
					resolve(res);
				})
			})
		}

		$('#btn_del_schedule').on('click', async function(){
			if (confirm('Hapus jadwal ini ?')) {
				var sid = $('#edit_schedule_id').val();
				var delSchedule = await ajax_delete_booking_schedules(sid);
				if (delSchedule.success) {
					$('#calendar').fullCalendar('removeEvents', sid);
					$('#mdlEditSchedule').modal('hide');
					toastr.success(delSchedule.message);
					table.ajax.reload();
				} else {
					toastr.error(delScheduletable.message);
				}
			}
		})

		$('body').on('click', '#btn_del_schedule_table', async function(){
			var delScheduletable = await ajax_delete_booking_schedules($(this).data('id'));
			if (delScheduletable.success) {
				$('#calendar').fullCalendar('removeEvents', $(this).data('id'));
				toastr.success(delScheduletable.message);
				table.ajax.reload();
			} else {
				toastr.error(delScheduletable.message);
			}
		});

		$('#btn_add_schedule').on('click', async function(){
			addFromTable = true;
			$('#mdlAddSchedule').modal('show');
		});

		$('body').on('click', '#btn_edit_schedule_table', async function(){
			var scheduleClick = await ajax_load_schedules($(this).data('id'));
			$('#mdlEditSchedule').modal('show').on('shown.bs.modal', function(){
				if(new Date(scheduleClick.data.start_date) >= todayDate) {
					$('#btn_update_schedule').show();
				} else {
					$('#btn_update_schedule').hide();
				}
				$("#formEditSchedule input[name=id]").val(scheduleClick.data.id);
				$("#formEditSchedule input[name=title]").val(scheduleClick.data.title);
				$("#formEditSchedule select[name=user_id]").val(scheduleClick.data.user_id).change();
				$("#formEditSchedule select[name=room_id]").val(scheduleClick.data.room_id).change();
				$("#formEditSchedule input[name=date]").val(scheduleClick.data.start_date);
				$("#formEditSchedule input[name=start_hour]").val(scheduleClick.data.start_hour);
				$("#formEditSchedule input[name=end_hour]").val(scheduleClick.data.end_hour);
			});
			editFromTable = true;
		});

		// $('#room_id_add').on('change', function(){
		// 	if ($(this).val() != '') {
		// 		ajax_get_today_schedules($(this).val(), $('#myDatepicker').val());
		// 	} else {
		// 		$('#container_schedules').html('');
		// 		$('#container_schedules_alert').show();
		// 	}
		// });

		$('#room_id_edit').on('change', function(){
			if ($(this).val() != '') {
				ajax_get_today_schedules($(this).val(), $('#myDatepicker_edit').val(), $('#edit_schedule_id').val());
			} else {
				$('#container_schedules_edit').html('');
				$('#container_schedules_alert_edit').show();
			}
		});

		$('#room_id_add').on('change', function(){
			if (addFromTable) {
				if ($(this).val() != '') {
					$('#myDatepicker').attr('disabled', false);
				} else {
					$('#myDatepicker').attr('disabled', true).val('');
				}
			}

			if ($('#myDatepicker').val() != '') {
				// biar ga error
				if ($(this).val() != '') {
					ajax_get_today_schedules($(this).val(), $('#myDatepicker').val());
				}
			} else {
				$('#container_schedules').html('');
				$('#container_schedules_alert').show();
			}
		})

		$('#myDatepicker').datepicker({
			autoclose: true,
			dateFormat: 'yy-mm-dd',
			minDate: todayDate,
			onSelect: function (date){
				ajax_get_today_schedules($('#room_id_add').val(), date);
			}
		})

		var startTimeTextBox = $('.start_hour');
		var endTimeTextBox = $('.end_hour');
		$.timepicker.timeRange(
			startTimeTextBox,
			endTimeTextBox,
			{
				minInterval: (1000*60*10),
				timeFormat: 'HH:mm',
				stepMinute: 5,
				start: {},
				end: {}
			}
			);

		$('#mdlApprove').on('shown.bs.modal', function(e){
			var mdl = $(e.relatedTarget);
			$("#mdlApprove select[name=status]").val(mdl.data('status'));
		});
	});
</script>
@endpush