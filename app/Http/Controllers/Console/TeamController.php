<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Image;

class TeamController extends Controller {
	public function index() {
		$teams = Team::orderBy('priority', 'asc')->orderBy('updated_at', 'desc')->get();
		return view('console.teams.index', ['page_title' => 'Team', 'active_menu' => 'teams', 'teams' => $teams]);
	}

	public function create() {
		return view('console.teams.create', ['page_title' => 'Team - Tambah Data', 'active_menu' => 'teams']);
	}

	public function store(Request $request) {
		$request->validate([
			'name' => 'required',
			'position' => 'required',
			// 'desc' => 'required',
			'priority' => 'required',
			'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:512',
			'socmed.*' => 'nullable|url',
		]);

		if ($request->image->isValid()) {
			$dir = '/images/teams/';
			if (!file_exists(public_path($dir))) {
				mkdir(public_path($dir), 0777, true);
				chmod(public_path($dir), 0777);
			}
			$image = $request->image;
			$imageName = Str::slug($request->name, '-').'-'.time().'.'.$image->extension();
			$filePath = public_path($dir);
			$img = Image::make($image->path());
			$img->resize(600, 600, function ($const) {
				$const->aspectRatio();
			})->save($filePath.'/'.$imageName);
		}

		$ar = new Team;
		$ar->name = trim($request->name);
		$ar->position = trim($request->position);
		// $ar->desc = trim($request->desc);
		$ar->image = $dir.$imageName;
		$ar->socmed = json_encode($request->socmed);
		$ar->priority = $request->priority;
		$ar->save();
		return redirect('console/teams')->with('notification', $this->flash_data('success', 'Berhasil', 'Team berhasil ditambahkan'));
	}

	public function show($id) {
		$policy = Team::findOrFail($id);
		return view('console.teams.show', ['policy' => $policy, 'page_title' => 'Team - Edit Data', 'active_menu' => 'teams']);
	}

	public function edit($id) {
		$team = Team::findOrFail($id);
		$socmed = json_decode($team->socmed, true);
		return view('console.teams.edit',['team' => $team, 'socmed' => $socmed, 'page_title' => 'Team - Edit Data', 'active_menu' => 'teams']);
	}

	public function update(Request $request, $id) {
		$request->validate([
			'name' => 'required',
			'position' => 'required',
			// 'desc' => 'required',
			'priority' => 'required',
			'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:512',
			'socmed.*' => 'nullable|url',
		]);

		$ar = Team::findOrFail($id);
		if ($request->hasFile('image')) {
			if ($request->image->isValid()) {
				$dir = '/images/teams/';
				if (!file_exists(public_path($dir))) {
					mkdir(public_path($dir), 0777, true);
					chmod(public_path($dir), 0777);
				}
				$image = $request->image;
				$imageName = Str::slug($request->name, '-').'-'.time().'.'.$image->extension();
				$filePath = public_path($dir);

				if (file_exists(public_path($ar->image))) {
					unlink(public_path($ar->image));
				}

				$img = Image::make($image->path());
				$img->resize(600, 600, function ($const) {
					$const->aspectRatio();
				})->save($filePath.'/'.$imageName);
			}
		}

		$ar->name = trim($request->name);
		$ar->position = trim($request->position);
		// $ar->desc = trim($request->desc);
		if ($request->hasFile('image')) {
			$ar->image = $dir.$imageName;
		}
		$ar->socmed = json_encode($request->socmed);
		$ar->priority = $request->priority;
		$ar->save();
		return redirect('console/teams')->with('notification', $this->flash_data('success', 'Berhasil', 'Team berhasil diupdate'));
	}

	public function destroy($id) {
		$team = Team::findOrFail($id);
		if (file_exists(public_path($team->image))) {
			unlink(public_path($team->image));
		}
		$team->delete();
		return redirect('console/teams')->with('notification', $this->flash_data('success', 'Berhasil', 'Team berhasil dihapus'));
	}

	public function ajax_approve_team(Request $request) {
		if ($request->ajax()) {
			if ($request->val == 1) {
				DB::table('teams')->where('id', $request->team_id)->update(["approved_by" => auth()->guard('admin')->user()->id]);
				return ['success'=>true, 'message'=> 'Team Aktif'];
			} else {
				DB::table('teams')->where('id', $request->team_id)->update(["approved_by" => null]);
				return ['success'=>false, 'message'=> 'Team Nonaktif'];
			}
		}
	}
}
