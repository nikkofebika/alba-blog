<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomBooking;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use DataTables;

class RoomController extends Controller {
	public function index() {
		$rooms = DB::table('rooms')->select('id','name','color')->whereNotNull('approved_by')->get();
		return view('dashboard.room', ['active_menu'=>'room', 'rooms' => $rooms]);
	}

	public function booking_schedule_list(Request $request) {
		if ($request->ajax()) {
			$data = RoomBooking::where('user_id', auth()->user()->id)->orderBy('start_date')->get();
			return Datatables::of($data)
			->addIndexColumn()
			->editColumn('room_id', function($data) { return $data->room->name;})
			->editColumn('start_date', function($data) { return date('d-m-Y', strtotime($data->start_date));})
			->editColumn('start_hour', function($data) { return substr($data->start_hour, 0, 5).' - '. substr($data->end_hour, 0, 5);})
			// ->editColumn('is_active', function($data) {
			// 	return '<div class="btn-group" role="group" aria-label="...">
			// 	<button type="button" title="Approved" class="btn btn-default btn-approved"><i class="fa fa-check"></i></button>
			// 	<button type="button" title="Waiting" class="btn btn-default btn-waiting active"><i class="fa fa-clock-o"></i></button>
			// 	<button type="button" title="Rejected" class="btn btn-default btn-rejected"><i class="fa fa-times"></i></button>
			// 	</div>';
			// })
			->editColumn('is_active', function($data) {
				$status = '';
				$btn = '';
				if ($data->is_active == 0) {
					$status = 'Processed';
					$btn = 'bg-secondary';
				} elseif ($data->is_active == 1) {
					$status = 'Approved';
					$btn = 'bg-success';
				} else {
					$status = 'Rejected';
					$btn = 'bg-danger';
				}
				return '<span class="badge '.$btn.'">'.$status.'</span>';
			})
			->addColumn('action', function($data){
				return '<button id="btn_edit_schedule_table" data-id="'.$data->id.'" class="btn btn-warning btn-sm" title="Edit"><i class="bx bx-edit"></i></button> <button id="btn_del_schedule_table" data-id="'.$data->id.'" onclick="return confirm(\'Hapus jadwal ini ?\')" class="btn btn-danger btn-sm" title="Hapus"><i class="bx bx-trash"></i></button>';
				// return '<a href="'.url('console/rooms/'.$data->id).'" class="btn btn-info btn-xs" title="Detail"><i class="fa fa-eye"></i></a> <a href="'.url('console/rooms/edit_booking_schedules', $data->id).'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></a> <button id="btn_del_schedule_table" data-id="'.$data->id.'" onclick="return confirm(\'Hapus jadwal ini ?\')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></button>';
			})
			->escapeColumns([])
			->make(true);
		}
	}

	public function ajax_load_schedules($scheduleId = null) {
		if ($scheduleId != null) {
			$schedules = DB::table('room_bookings')->select('id','user_id','room_id','title',DB::raw('DATE_FORMAT(start_date, "%Y-%m-%d") as start_date'),'start_hour','end_hour')->where('id', $scheduleId)->first();
		} else {
			$schedules = DB::table('room_bookings')->join('rooms', 'room_bookings.room_id', '=', 'rooms.id')->select('room_bookings.id','room_bookings.title','room_bookings.start_date','room_bookings.end_date','rooms.name','rooms.color')->orderBy('room_bookings.start_date', 'asc')->get();
		}
		$data = [];
		if ($scheduleId != null) {
			$data = $schedules;
		} else {
			if (count($schedules) > 0) {
				foreach ($schedules as $s) {
					$data[] = [
						'id' => $s->id,
						'title' => $s->title,
						'start' => $s->start_date,
						'end' => $s->end_date,
						'allDay' => false,
						'backgroundColor' => $s->color,
						'borderColor' => $s->color
					];
				}
			}
		}
		
		return response()->json(['success' => true, 'data' => $data]);
	}

	public function ajax_move_schedule() {
		$schedule = RoomBooking::findOrFail($_POST['id']);
		if($schedule){

			$start_time = date('Y-m-d H:i:s', strtotime($_POST['start_time']));
			$end_time = date('Y-m-d H:i:s', strtotime($_POST['end_time']));
			$st = new \DateTime($start_time);
			$et = new \DateTime($end_time);

			$date_start_time = $st->format('Y-m-d');
			$time_start_time = $st->format('H:i:s');
			$time_end_time = $et->format('H:i:s');

			$dataCek = ['room_id' => $schedule->room_id, 'date' => $date_start_time, 'start_hour' => $time_start_time, 'end_hour' => $time_end_time];
			if (cekAvailableSchedules($dataCek, $_POST['id']) == false) {
				return ['success' => false, 'message' => 'Jam sudah digunakan. Harap pilih jam lain.'];
			}
			$schedule->start_date = $start_time;
			$schedule->end_date = $end_time;
			$schedule->start_hour = $time_start_time;
			$schedule->end_hour = $time_end_time;
			$schedule->save();
			return ['success' => true, 'message' => 'Jadwal booking berhasil diupdate.'];
		}
		return ['success' => false, 'message' => 'Jam sudah digunakan. Harap pilih jam lain.'];
	}

	public function ajax_create_booking_schedules(Request $request) {
		$request->validate([
			'title' => 'required',
			'room_id' => 'required',
			'date' => 'required|date',
			'start_hour' => 'required',
			'end_hour' => 'required',
		]);

		$start_hour = date('H:i:s', strtotime($request->start_hour));
		$end_hour = date('H:i:s', strtotime($request->end_hour));
		if ($end_hour <= $start_hour) {
			dd($_POST);
			return response()->json(['success' => false, 'message' => 'Jam mulai harus lebih kecil dari jam selesai.']);
		}

		$dataCek = ['room_id' => $request->room_id, 'date' => date('Y-m-d', strtotime($request->date)), 'start_hour' => $start_hour, 'end_hour' => $end_hour];

		if ($request->has('id')) {
			if (cekAvailableSchedules($dataCek, $request->id) == false) {
				return response()->json(['success' => false, 'message' => 'Jam sudah digunakan. Harap pilih jam lain.']);
			}
			$schedule = RoomBooking::findOrFail($request->id);
		} else {
			if (date('Y-m-d', strtotime($request->date)) < date('Y-m-d')) {
				return response()->json(['success' => false, 'message' => 'Anda hanya dapat membuat jadwal minimal hari ini!']);
			}
			if (cekAvailableSchedules($dataCek) == false) {
				return response()->json(['success' => false, 'message' => 'Jam sudah digunakan. Harap pilih jam lain.']);
			}
			$schedule = new RoomBooking;
		}

		$schedule->created_by = auth()->guard('admin')->user()->id;
		$schedule->user_id = $request->user_id;
		$schedule->room_id = $request->room_id;
		$schedule->title = $request->title;
		$schedule->start_date = date('Y-m-d', strtotime($request->date)).' '.$start_hour;
		$schedule->end_date = date('Y-m-d', strtotime($request->date)).' '.$end_hour;
		$schedule->start_hour = $start_hour;
		$schedule->end_hour = $end_hour;
		$schedule->save();

		$dataSuccess = [
			'id' => $schedule->id,
			'title' => $schedule->title,
			'start' => $schedule->start_date,
			'end' => $schedule->end_date,
			'allDay' => false,
			'backgroundColor' => $schedule->room->color,
			'borderColor' => $schedule->room->color
		];
		return response()->json(['success' => true, 'data' => $dataSuccess, 'message' => 'Jadwal booking berhasil dibuat']);
	}

	public function ajax_get_today_schedules($roomId, $date, $scheduleId = '') {
		$schedule = DB::table('room_bookings')->select('start_hour','end_hour')->where('room_id', $roomId);
		if ($scheduleId != '') {
			$schedule->where('id', '!=', $scheduleId);
		}
		$schedule = $schedule->whereDate('start_date', date('Y-m-d', strtotime($date)))->orderBy('start_date','asc')->get();
		$html = '';
		if (count($schedule) > 0) {
			$html .= '<ul>';
			foreach ($schedule as $d){
				$html .= '<li>'. $d->start_hour .' - '. $d->end_hour .'</li>';
			}
			$html .= '</ul>';
			$html .= '<strong class="text-warning">Silahkan pilih selain jam diatas!</strong>';
		} else {
			$html = '<div class="alert alert-info">Belum ada jadwal booking di ruangan ini.</div>';
		}
		return $html;
	}

	public function ajax_delete_booking_schedules(){
		if (RoomBooking::findOrFail($_POST['id'])->delete()) {
			return response()->json(['success' => true, 'toast' => 'success', 'message' => 'Jadwal booking berhasil dihapus']);
		}
		return response()->json(['success' => true, 'toast' => 'error', 'message' => 'Gagal menghapus jadwal!!!']);
	}
}
