<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use DataTables;

class RoomController extends Controller {
	public function index() {
		return view('console.rooms.index', ['page_title' => 'Room', 'active_menu' => 'rooms']);
	}

	public function getRooms(Request $request) {
		if ($request->ajax()) {
			$data = Room::all();
			return Datatables::of($data)
			->addIndexColumn()
			->editColumn('image', function($data) {return '<a href="'.asset($data->image).'" target="_blank"><img src="'.asset($data->image).'" width="100"/></a>';})
			->editColumn('color', function($data) {return '<div style="padding: 10px; background-color: '.$data->color.'"></div>';})
			->editColumn('approved_by', function($data) {
				$checked = $data->approved_by !== null ? 'checked' : '';
				return '<input type="checkbox" '.$checked.' class="check_approve" data-room_id="'.$data->id.'" />';
			})
			->addColumn('action', function($data){
				return '<a href="'.route('console.rooms.edit', $data->id).'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></a> <form method="POST" onsubmit="return confirm(\'Hapus '.$data->name.' ?\')" action="'.route("console.rooms.destroy", $data->id).'" class="d-inline"><input type="hidden" name="_token" value="'.csrf_token().'" /><input type="hidden" value="DELETE" name="_method"><button type="submit" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></button></form>';
			})
			->escapeColumns([])
			->make(true);
		}
	}

	public function create() {
		return view('console.rooms.create', ['page_title' => 'Room - Tambah Data', 'active_menu' => 'rooms']);
	}

	public function store(Request $request) {
		$request->validate([
			'name' => 'required|unique:rooms,name',
			'description' => 'required',
			'is_active' => 'required',
			'color' => 'required|min:7|unique:rooms,color',
			'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:512',
		]);

		if ($request->image->isValid()) {
			$imageName = Str::slug($request->name, '-').'-'.time().'.'.$request->image->extension();
			$dir = '/images/rooms/';
			if (!file_exists(public_path($dir))) {
				mkdir(public_path($dir), 0777, true);
				chmod(public_path($dir), 0777);
			}
			$request->image->move(public_path($dir), $imageName);
		}

		$room = new Room;
		$room->name = $request->name;
		$room->description = $request->description;
		$room->color = $request->color;
		$room->image = $dir.$imageName;
		$room->approved_by = $request->is_active == 1 ? auth()->guard('admin')->user()->id : null;
		$room->save();
		return redirect('console/rooms')->with('notification', $this->flash_data('success', 'Berhasil', 'Room Berhasil Ditambahkan'));
	}

	public function show($id) {
		$room = Room::findOrFail($id);
		return view('console.rooms.show', ['room'=>$room]);
	}

	public function edit($id) {
		$room = Room::findOrFail($id);
		return view('console.rooms.edit',['room' => $room, 'page_title' => 'Room - Edit Data', 'active_menu' => 'rooms']);
	}

	public function update(Request $request, $id) {
		$request->validate([
			'name' => 'required|unique:rooms,name,'.$id,
			'description' => 'required',
			'is_active' => 'required',
			'color' => 'required|min:7|unique:rooms,color,'.$id,
			'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:512',
		]);

		$room = Room::findOrFail($id);
		if ($request->hasFile('image')) {
			if ($request->image->isValid()) {
				$imageName = Str::slug($request->name, '-').'-'.time().'.'.$request->image->extension();
				$dir = '/images/rooms/';
				if (!file_exists(public_path($dir))) {
					mkdir(public_path($dir), 0777, true);
					chmod(public_path($dir), 0777);
				}
				if (file_exists(public_path($dir))) {
					unlink(public_path($room->image));
				}
				$request->image->move(public_path($dir), $imageName);
			}
		}

		$room->name = $request->name;
		$room->description = $request->description;
		$room->color = $request->color;
		$room->approved_by = $request->is_active == 1 ? auth()->guard('admin')->user()->id : null;
		if ($request->hasFile('image')) {
			$room->image = $dir.$imageName;
		}
		$room->save();
		return redirect('console/rooms')->with('notification', $this->flash_data('success', 'Berhasil', 'Room Berhasil Diupdate'));
	}

	public function destroy($id) {
		$room = Room::findOrFail($id);
		if (pathinfo($room->image, PATHINFO_FILENAME) !== 'sample_room') {
			if (file_exists(public_path($room->image))) {
				unlink(public_path($room->image));
			}
		}
		$room->delete();
		return redirect('console/rooms')->with('notification', $this->flash_data('success', 'Berhasil', 'Room Berhasil Dihapus'));
	}

	public function ajax_approve_room(Request $request) {
		if ($request->ajax()) {
			if (DB::table('rooms')->where('id', $_POST['room_id'])->update(["approved_by" => auth()->guard('admin')->user()->id])) {
				if ($_POST['status'] == 1) {
					return ['success'=>true, 'message'=> 'Room Approved'];
				}
				return ['success'=>false, 'message'=> 'Room Unapproved'];
			}
			return ['success'=>false, 'message'=> 'Room Unapproved'];
		}
	}

	public function booking_schedules() {
		$users = DB::table('users')->select('id','name')->where('is_active', 1)->get();
		$rooms = DB::table('rooms')->select('id','name','color')->whereNotNull('approved_by')->get();
		return view('console.rooms.booking_schedules', ['page_title' => 'Jadwal Booking Ruangan', 'active_menu' => 'booking_schedules', 'users' => $users, 'rooms' => $rooms]);
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

	public function booking_schedule_list(Request $request) {
		if ($request->ajax()) {
			$data = RoomBooking::orderBy('start_date')->get();
			return Datatables::of($data)
			->addIndexColumn()
			->editColumn('room_id', function($data) { return $data->room->name;})
			->editColumn('user_id', function($data) { return $data->user->name;})
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
					$status = 'Waiting';
					$btn = 'btn-warning';
				} elseif ($data->is_active == 1) {
					$status = 'Approved';
					$btn = 'btn-success';
				} else {
					$status = 'Rejected';
					$btn = 'btn-danger';
				}
				return '<button class="btn '.$btn.' btn-xs" data-status="'.$data->is_active.'" data-toggle="modal" data-target="#mdlApprove">'.$status.'</button>';
			})
			->addColumn('action', function($data){
				return '<button id="btn_edit_schedule_table" data-id="'.$data->id.'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></button> <button id="btn_del_schedule_table" data-id="'.$data->id.'" onclick="return confirm(\'Hapus jadwal ini ?\')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></button>';
				// return '<a href="'.url('console/rooms/'.$data->id).'" class="btn btn-info btn-xs" title="Detail"><i class="fa fa-eye"></i></a> <a href="'.url('console/rooms/edit_booking_schedules', $data->id).'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></a> <button id="btn_del_schedule_table" data-id="'.$data->id.'" onclick="return confirm(\'Hapus jadwal ini ?\')" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></button>';
			})
			->escapeColumns([])
			->make(true);
		}
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
			die('ada id = ' . $request->id);
			if (cekAvailableSchedules($dataCek, $request->id) == false) {
				return response()->json(['success' => false, 'message' => 'Jam sudah digunakan. Harap pilih jam lain.']);
			}
			$schedule = RoomBooking::findOrFail($request->id);
		} else {
			die('GX ada id');
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

	public function create_booking_schedules(Request $request) {
		if ($request->isMethod('POST')) {
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
				return response()->json(['success' => false, 'message' => 'Jam mulai harus lebih kecil dari jam selesai.']);
			}

			$dataCek = ['room_id' => $request->room_id, 'date' => date('Y-m-d', strtotime($request->date)), 'start_hour' => $start_hour, 'end_hour' => $end_hour];
			if (cekAvailableSchedules($dataCek) == false) {
				return back()->withInput()->with('notification', $this->flash_data('error', 'Gagal', 'Jam sudah digunakan. Harap pilih jam lain.'));
			}

			$schedule = new RoomBooking;
			$schedule->created_by = auth()->guard('admin')->user()->id;
			$schedule->user_id = $request->user_id;
			$schedule->room_id = $request->room_id;
			$schedule->title = $request->title;
			$schedule->start_date = date('Y-m-d', strtotime($request->date)).' '.$request->start_hour;
			$schedule->end_date = date('Y-m-d', strtotime($request->date)).' '.$request->end_hour;
			$schedule->start_hour = $request->start_hour;
			$schedule->end_hour = $request->end_hour;
			$schedule->save();
			return redirect('console/rooms/booking_schedules');
		}
		$users = DB::table('users')->where('is_active', 1)->get();
		$rooms = DB::table('rooms')->whereNotNull('approved_by')->get();
		return view('console.rooms.create_booking_schedules', ['page_title' => 'Jadwal Booking Ruangan - Tambah Data', 'active_menu' => 'booking_schedules', 'users' => $users, 'rooms' => $rooms]);
	}

	public function edit_booking_schedules(Request $request, $id) {
		$schedule = RoomBooking::findOrFail($id);
		if ($request->isMethod('PUT')) {
			$request->validate([
				'title' => 'required',
				'room_id' => 'required',
				'date' => 'required|date',
				'start_hour' => 'required',
				'end_hour' => 'required',
			]);

			// $this->debug($request->all());
			$start_hour = date('H:i:s', strtotime($request->start_hour));
			$end_hour = date('H:i:s', strtotime($request->end_hour));
			if ($end_hour <= $start_hour) {
				return response()->json(['success' => false, 'message' => 'Jam mulai harus lebih kecil dari jam selesai.']);
			}

			$dataCek = ['room_id' => $request->room_id, 'date' => date('Y-m-d', strtotime($request->date)), 'start_hour' => $start_hour, 'end_hour' => $end_hour];
			if (cekAvailableSchedules($dataCek, $id) == false) {
				return back()->withInput()->with('notification', $this->flash_data('error', 'Gagal', 'Jam sudah digunakan. Harap pilih jam lain.'));
			}

			$schedule->created_by = auth()->guard('admin')->user()->id;
			$schedule->user_id = $request->user_id;
			$schedule->room_id = $request->room_id;
			$schedule->title = $request->title;
			$schedule->start_date = date('Y-m-d', strtotime($request->date)).' '.$request->start_hour;
			$schedule->end_date = date('Y-m-d', strtotime($request->date)).' '.$request->end_hour;
			$schedule->start_hour = $request->start_hour;
			$schedule->end_hour = $request->end_hour;
			$schedule->save();
			return redirect('console/rooms/booking_schedules');
		}
		$users = DB::table('users')->where('is_active', 1)->get();
		$rooms = DB::table('rooms')->whereNotNull('approved_by')->get();
		return view('console.rooms.edit_booking_schedules', ['page_title' => 'Jadwal Booking Ruangan - Edit Data', 'active_menu' => 'booking_schedules', 'schedule' => $schedule, 'users' => $users, 'rooms' => $rooms]);
	}

	public function ajax_delete_booking_schedules(){
		if (RoomBooking::findOrFail($_POST['id'])->delete()) {
			return response()->json(['success' => true, 'toast' => 'success', 'message' => 'Jadwal booking berhasil dihapus']);
		}
		return response()->json(['success' => true, 'toast' => 'error', 'message' => 'Gagal menghapus jadwal!!!']);
	}
}
