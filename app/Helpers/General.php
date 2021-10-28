<?php
use Illuminate\Support\Facades\DB;
function cekAvailableSchedules($data, $roomId = null) {
	$schedule = DB::table('room_bookings')->where('room_id', $data['room_id']);
	if ($roomId != null) {
		$schedule->where('id', '!=', $roomId);
	}
	$schedule = $schedule->whereDate('start_date', date('Y-m-d', strtotime($data['date'])))->where('start_hour', $data['start_hour'])->where('end_hour', $data['end_hour'])->count();
	if ($schedule > 0) {
		return false;
		// return back()->withInput()->with('notification', $this->flash_data('error', 'Gagal', 'Jam sudah digunakan. Harap pilih jam lain.'));
	} else {
		$schedules = DB::table('room_bookings')->select('start_hour', 'end_hour')->where('room_id', $data['room_id']);
		if ($roomId != null) {
			$schedules->where('id', '!=', $roomId);
		}
		$schedules = $schedules->whereDate('start_date', date('Y-m-d', strtotime($data['date'])))->get();
		foreach ($schedules as $s) {
			if (($s->start_hour > $data['start_hour'] && $s->start_hour < $data['end_hour']) || ($s->end_hour > $data['start_hour'] && $s->end_hour < $data['end_hour'])) {
				return false;
			}
		}
	}
	return true;
}
?>