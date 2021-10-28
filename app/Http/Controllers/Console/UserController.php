<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use DataTables;

class UserController extends Controller {
	public function index() {
		return view('console.users.index', ['page_title' => 'Users', 'active_menu' => 'users']);
	}

	public function getUsers(Request $request) {
		if ($request->ajax()) {
			$data = User::select(['id','name','email','is_active'])->get();
			return Datatables::of($data)
			->addIndexColumn()
			->editColumn('is_active', function($data) {
				$checked = $data->is_active == 1 ? 'checked' : '';
				return '<input type="checkbox" '.$checked.' class="check_active" data-user_id="'.$data->id.'" />';
			})
			->addColumn('action', function($data){
				$btnDel = $data->id !== auth()->user()->id ? '<form method="POST" onsubmit="return confirm(\'Hapus '.$data->name.' ?\')" action="'.route("console.users.destroy", $data->id).'" class="d-inline"><input type="hidden" name="_token" value="'.csrf_token().'" /><input type="hidden" value="DELETE" name="_method"><button type="submit" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></button></form>' : '';
				return '<a href="'.route('console.users.show', $data->id).'" class="btn btn-info btn-xs" title="Detail"><i class="fa fa-eye"></i></a> <a href="'.route('console.users.edit', $data->id).'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></a> '.$btnDel;
				// return '<button class="btn btn-info btn-xs" title="Detail" data-id="'.$data->id.'" data-toggle="modal" data-target="#mdlShowDetail"><i class="fa fa-eye"></i></button> <a href="'.route('console.users.edit', $data->id).'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></a> '.$btnDel;
			})
			->escapeColumns([])
			->make(true);
		}
	}

	public function create() {
		return view('console.users.create', ['page_title' => 'Users - Tambah Data', 'active_menu' => 'users']);
	}

	public function store(Request $request) {
		$request->validate([
			'name' => 'required|max:255',
			'email' => 'required|email|unique:users|max:255',
			'password' => 'required',
			'photo' => 'required|image|mimes:jpeg,png,jpg,svg|max:512',
		]);
		if ($request->photo->isValid()) {
			$photoName = Str::slug($request->name, '-').'-'.time().'.'.$request->photo->extension();
			$dir = '/images/users/';
			if (!file_exists(public_path($dir))) {
				mkdir(public_path($dir), 0777, true);
				chmod(public_path($dir), 0777);
			}
			$request->photo->move(public_path($dir), $photoName);
		}

		$user = new User;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->photo = $dir.$photoName;
		$user->save();
		return redirect('console/users')->with('notification', $this->flash_data('success', 'Berhasil', 'User Berhasil Ditambahkan'));
	}

	public function show($id) {
		$user = User::findOrFail($id);
		return view('console.users.show',['user' => $user, 'page_title' => 'User - Profil User', 'active_menu' => 'users']);
		// return '<div class="box box-widget widget-user-2"><div class="widget-user-header bg-light-blue"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><div class="widget-user-image"><img class="img-circle" src="'.asset($user->photo).'" alt="User Avatar"></div><h3 class="widget-user-username">'.$user->name.'</h3><h5 class="widget-user-desc">'.$status.'</h5></div><div class="box-footer no-padding"><ul class="nav nav-stacked"><li><a href="#"><strong>Email</strong> : '.$user->email.'</a></li><li><a href="#"><strong>Created at</strong> : '.$user->created_at->format('H:i d-m-Y').'</a></li></ul></div></div>';
	}

	public function edit($id) {
		$user = User::findOrFail($id);
		return view('console.users.edit',['user' => $user, 'page_title' => 'User - Edit Data', 'active_menu' => 'users']);
	}

	public function update(Request $request, $id) {
		$request->validate([
			'name' => 'required|max:255',
			'email' => 'required|email|unique:users,email,'.$id,
			'photo' => 'image|mimes:jpeg,png,jpg,svg|max:512',
		]);
		$user = User::findOrFail($id);
		if ($request->hasFile('photo')) {
			if ($request->photo->isValid()) {
				$photoName = Str::slug($request->name, '-').'-'.time().'.'.$request->photo->extension();
				$dir = '/images/users/';
				if (!file_exists(public_path($dir))) {
					mkdir(public_path($dir), 0777, true);
					chmod(public_path($dir), 0777);
				}
				if (pathinfo($user->photo, PATHINFO_FILENAME) !== 'user_default') {
					unlink(public_path($user->photo));
				}
				$request->photo->move(public_path($dir), $photoName);
			}
		}

		$user->name = $request->name;
		$user->email = $request->email;
		if ($request->password) {
			$user->password = bcrypt($request->password);
		}
		if ($request->hasFile('photo')) {
			$user->photo = $dir.$photoName;
		}
		$user->save();
		return redirect('console/users')->with('notification', $this->flash_data('success', 'Berhasil', 'User Berhasil Diupdate'));
	}

	public function destroy($id) {
		$user = User::findOrFail($id);
		if (pathinfo($user->photo, PATHINFO_FILENAME) !== 'user_default') {
			unlink(public_path($user->photo));
		}
		$user->delete();
		return redirect('console/users')->with('notification', $this->flash_data('success', 'Berhasil', 'User Berhasil Dihapus'));
	}

	public function ajax_active_user(Request $request) {
		if ($request->ajax()) {
			if (DB::table('users')->where('id', $_POST['user_id'])->update(["is_active" => $_POST['val']])) {
				if ($_POST['val'] == 1) {
					return ['success'=>true, 'message'=> 'User Aktif'];
				}
				return ['success'=>false, 'message'=> 'User Nonaktif'];
			}
			return ['success'=>false, 'message'=> 'User Nonaktif'];
		}
	}
}
