@extends('console.layouts.master')
@push('styles')
<link href="{{ asset('backend/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
<link href="https://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" rel="stylesheet">
<link href="{{ asset('backend/bower_components/timepicker/timepicker.css') }}" rel="stylesheet">
<link href="{{ asset('backend/bower_components/summernote/summernote.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="content-wrapper">
	<section class="content-header d-flex justify-content-between align-items-center">
		<h1>{{ $page_title }}</h1>
		<a href="{{ url('console/rooms/booking_schedules') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<?php if(session('notification')){echo session('notification');} ?>
					<form method="POST" action="" autocomplete="off">
						@csrf @method('PUT')
						<div class="box-body">
							<div class="form-group @error('title') has-error @enderror">
								<label>Subjek <span class="text-danger">*</span></label>
								<input type="text" name="title" class="form-control" required placeholder="Nama event" value="{{ $schedule->title }}">
								@error('title')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group @error('user_id') has-error @enderror">
										<label>User <span class="text-danger">*</span></label>
										<select name="user_id" class="form-control select2" required>
											<option value="">- Pilih User -</option>
											@foreach ($users as $u)
											<option value="{{ $u->id }}" {{ $u->id == $schedule->user_id ? "selected" : "" }}>{{ $u->name }}</option>
											@endForeach
										</select>
										@error('user_id')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="form-group @error('room_id') has-error @enderror">
										<label>Ruangan <span class="text-danger">*</span></label>
										<select name="room_id" id="room_id" class="form-control select2" required>
											<option value="">- Pilih Ruangan -</option>
											@foreach ($rooms as $r)
											<option value="{{ $r->id }}" {{ $r->id == $schedule->room_id ? "selected" : "" }}>{{ $r->name }}</option>
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
										<input type="text" name="date" class="form-control" value="{{ date('Y-m-d', strtotime($schedule->start_date)) }}" required id="myDatepicker" readonly>
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
										<input type="text" name="start_hour" id="start_hour" class="form-control" required value="{{ date('H:i', strtotime($schedule->start_hour)) }}">
										@error('start_hour')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="form-group @error('end_hour') has-error @enderror">
										<label>Jam Selesai <span class="text-danger">*</span></label>
										<input type="text" name="end_hour" id="end_hour" class="form-control" required value="{{ date('H:i', strtotime($schedule->end_hour)) }}">
										@error('end_hour')
										<span class="help-block">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary btn-block" id="btn_submit"><i class="fa fa-paper-plane"></i> Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
@endSection
@push('scripts')
<script src="{{ asset('backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('backend/bower_components/timepicker/timepicker.js') }}"></script>
<script src="{{ asset('backend/bower_components/summernote/summernote.min.js') }}"></script>
<script>
	$(function () {
		$('.select2').select2();
		function ajax_get_today_schedules(roomId, date){
			$.get('{{ url("console/rooms/ajax_get_today_schedules") }}/' + roomId + '/' + date +'/'+ '{{ $schedule->id }}', function (res){
				$('#container_schedules_alert').hide();
				$('#container_schedules').html(res)
			})
		}
		ajax_get_today_schedules($('#room_id').val(), $('#myDatepicker').val());
		$('#room_id').on('change', function(){
			if ($(this).val() != '') {
				$('#myDatepicker').attr('disabled', false);
			} else {
				$('#myDatepicker').attr('disabled', true).val('');
			}

			if ($('#myDatepicker').val() != '') {
				ajax_get_today_schedules($(this).val(), $('#myDatepicker').val());
			} else {
				$('#container_schedules').html('');
				$('#container_schedules_alert').show();
			}
		})
		$('#myDatepicker').datepicker({
			autoclose: true,
			dateFormat: 'yy-mm-dd',
			minDate: new Date(),
			onSelect: function (date){
				ajax_get_today_schedules($('#room_id').val(), date);
			}
		})

		var startTimeTextBox = $('#start_hour');
		var endTimeTextBox = $('#end_hour');
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
	});
</script>
@endpush