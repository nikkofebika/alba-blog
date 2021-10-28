<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Item;
use App\Models\SavedSearch;

class DashboardController extends Controller {
	public function personal_identity(Request $request){
		$user = User::findOrFail(auth()->user()->id);
		if ($request->isMethod('POST')) {
			$request->validate([
				'name' => 'required',
				'phone' => 'required',
				'address' => 'required',
				'village_id' => 'required|numeric',
			]);

			$user->name = $request->name;
			$user->phone = $request->phone;
			$user->address = $request->address;
			$user->village_id = $request->village_id;
			if ($request->has('password') && $request->password != "" && $request->password != null) {
				$user->password = Hash::make($request->password);
			}
			$user->updated_at = date('Y-m-d H:i:s');
			$user->save();
			return redirect('dashboard/profile/personal-identity');
		}
		return view("dashboard.profile.personal_identity", ['active_menu' => 'personal-identity', 'user' => $user]);
	}

	public function education_training(Request $request){
		$user = User::findOrFail(auth()->user()->id);
		return view("dashboard.profile.education_training", ['active_menu' => 'education-training', 'user' => $user]);
	}

	public function family(Request $request){
		$user = User::findOrFail(auth()->user()->id);
		return view("dashboard.profile.family", ['active_menu' => 'family', 'user' => $user]);
	}

	public function working_experience(Request $request){
		$user = User::findOrFail(auth()->user()->id);
		return view("dashboard.profile.working_experience", ['active_menu' => 'working-experience', 'user' => $user]);
	}


	public function lost_item(){
		return view("dashboard.lost_item", ['active_menu' => 'lost-item', 'show_filter' => true]);
	}

	public function create_lost_item(Request $request){
		if ($request->isMethod('POST')) {
			$request->validate([
				'name' => 'required',
				'lost_date' => 'required',
				'tag' => 'required',
				'item_type_id' => 'required',
				'model' => 'required',
				'color' => 'required',
				'province_id' => 'required|numeric',
				'regency_id' => 'required|numeric',
				'district_id' => 'required|numeric',
				'village_id' => 'required|numeric',
				'specific_location' => 'required',
			]);
			// dd($request->all());

			$saved_images = [];
			$images_number = 1;
			$lost_date = date('Y-m-d H:i:s', strtotime($request->lost_date));
			foreach ($request->images as $image) {
				if ($image->isValid()) {
					$imageName = Str::slug($request->name, '-').'-'.time().'-'.$images_number++.'.'.$image->extension();
					$dir = '/images/items/';
					if (!file_exists(public_path($dir))) {
						mkdir(public_path($dir), 0777, true);
						chmod(public_path($dir), 0777);
					}
					$image->move(public_path($dir), $imageName);
					$saved_images[] = $dir.$imageName;
				}
			}

			$item = new Item;
			$item->user_id = auth()->user()->id;
			$item->name = $request->name;
			$item->lost_date = date('Y-m-d H:i:s', strtotime($request->lost_date));
			$item->item_type_id = $request->item_type_id;
			$item->model = $request->model;
			$item->description = $request->description;
			$item->tag = $request->tag;
			$item->color = $request->color;
			$item->location_id = $request->location_id;
			$item->province_id = $request->province_id;
			$item->regency_id = $request->regency_id;
			$item->district_id = $request->district_id;
			$item->village_id = $request->village_id;
			$item->specific_location = $request->specific_location;
			$item->images = json_encode($saved_images);
			$item->save();
			return redirect('dashboard/lost-item')->with('notification', $this->flash_notif('Item berhasil ditambahkan'));
		}
		$provinces = DB::table('provinces')->get();
		$locations = DB::table('locations')->get();
		$item_types = DB::table('item_types')->get();
		return view("dashboard.create_lost_item", ['active_menu' => 'dashboard', 'provinces' => $provinces, 'locations' => $locations, 'item_types' => $item_types]);
	}

	public function edit_lost_item(Request $request, $itemId){
		$item = Item::findOrFail($itemId);
		if ($request->isMethod('PUT')) {
			$request->validate([
				'name' => 'required',
				'lost_date' => 'required',
				'tag' => 'required',
				'item_type_id' => 'required',
				'model' => 'required',
				'color' => 'required',
				'province_id' => 'required|numeric',
				'regency_id' => 'required|numeric',
				'district_id' => 'required|numeric',
				'village_id' => 'required|numeric',
				'specific_location' => 'required',
			]);
			// dd($request->all());

			if ($request->has('images') && count($request->images) > 0) {
				$saved_images = [];
				$images_number = 1;
				foreach ($request->images as $image) {
					if ($image->isValid()) {
						$imageName = Str::slug($request->name, '-').'-'.time().'-'.$images_number++.'.'.$image->extension();
						$dir = '/images/items/';
						if (!file_exists(public_path($dir))) {
							mkdir(public_path($dir), 0777, true);
							chmod(public_path($dir), 0777);
						}
						$image->move(public_path($dir), $imageName);
						$saved_images[] = $dir.$imageName;
					}
				}

				foreach (json_decode($item->images, true) as $image) {
					unlink(public_path($image));
				}
			}

			$item->user_id = auth()->user()->id;
			$item->name = $request->name;
			$item->lost_date = date('Y-m-d H:i:s', strtotime($request->lost_date));
			$item->item_type_id = $request->item_type_id;
			$item->model = $request->model;
			$item->description = $request->description;
			$item->tag = $request->tag;
			$item->color = $request->color;
			$item->location_id = $request->location_id;
			$item->province_id = $request->province_id;
			$item->regency_id = $request->regency_id;
			$item->district_id = $request->district_id;
			$item->village_id = $request->village_id;
			$item->specific_location = $request->specific_location;
			if (isset($saved_images) && count($saved_images) > 0) {
				$item->images = json_encode($saved_images);
			}
			$item->save();
			return redirect('dashboard/lost-item')->with('notification', $this->flash_notif('Item berhasil diupdate'));
		}
		$provinces = DB::table('provinces')->get();
		$locations = DB::table('locations')->get();
		$item_types = DB::table('item_types')->get();
		return view("dashboard.edit_lost_item", ['active_menu' => 'dashboard', 'item' => $item, 'provinces' => $provinces, 'locations' => $locations, 'item_types' => $item_types]);
	}

	public function find_item(Request $request){
		return view("dashboard.find_item", ['active_menu' => 'find-item', 'show_filter' => true]);
	}

	public function create_find_item(Request $request){
		if ($request->isMethod('POST')) {
			$request->validate([
				'name' => 'required',
				'find_date' => 'required',
				'tag' => 'required',
				'item_type_id' => 'required',
				'model' => 'required',
				'color' => 'required',
				'province_id' => 'required|numeric',
				'regency_id' => 'required|numeric',
				'district_id' => 'required|numeric',
				'village_id' => 'required|numeric',
				'specific_location' => 'required',
			]);
			// dd($request->all());

			$saved_images = [];
			$images_number = 1;
			$find_date = date('Y-m-d H:i:s', strtotime($request->find_date));
			foreach ($request->images as $image) {
				if ($image->isValid()) {
					$imageName = Str::slug($request->name, '-').'-'.time().'-'.$images_number++.'.'.$image->extension();
					$dir = '/images/items/';
					if (!file_exists(public_path($dir))) {
						mkdir(public_path($dir), 0777, true);
						chmod(public_path($dir), 0777);
					}
					$image->move(public_path($dir), $imageName);
					$saved_images[] = $dir.$imageName;
				}
			}

			$item = new Item;
			$item->user_id = auth()->user()->id;
			$item->name = $request->name;
			$item->find_date = date('Y-m-d H:i:s', strtotime($request->find_date));
			$item->item_type_id = $request->item_type_id;
			$item->model = $request->model;
			$item->description = $request->description;
			$item->tag = $request->tag;
			$item->color = $request->color;
			$item->location_id = $request->location_id;
			$item->province_id = $request->province_id;
			$item->regency_id = $request->regency_id;
			$item->district_id = $request->district_id;
			$item->village_id = $request->village_id;
			$item->specific_location = $request->specific_location;
			$item->images = json_encode($saved_images);
			$item->save();
			return redirect('dashboard/find-item')->with('notification', $this->flash_notif('Item berhasil ditambahkan'));
		}
		$provinces = DB::table('provinces')->get();
		$locations = DB::table('locations')->get();
		$item_types = DB::table('item_types')->get();
		return view("dashboard.create_find_item", ['active_menu' => 'find-item', 'provinces' => $provinces, 'locations' => $locations, 'item_types' => $item_types]);
	}

	public function edit_find_item(Request $request, $itemId){
		$item = Item::findOrFail($itemId);
		if ($request->isMethod('PUT')) {
			$request->validate([
				'name' => 'required',
				'find_date' => 'required',
				'tag' => 'required',
				'item_type_id' => 'required',
				'model' => 'required',
				'color' => 'required',
				'province_id' => 'required|numeric',
				'regency_id' => 'required|numeric',
				'district_id' => 'required|numeric',
				'village_id' => 'required|numeric',
				'specific_location' => 'required',
			]);
			// dd($request->all());

			if ($request->has('images') && count($request->images) > 0) {
				$saved_images = [];
				$images_number = 1;
				foreach ($request->images as $image) {
					if ($image->isValid()) {
						$imageName = Str::slug($request->name, '-').'-'.time().'-'.$images_number++.'.'.$image->extension();
						$dir = '/images/items/';
						if (!file_exists(public_path($dir))) {
							mkdir(public_path($dir), 0777, true);
							chmod(public_path($dir), 0777);
						}
						$image->move(public_path($dir), $imageName);
						$saved_images[] = $dir.$imageName;
					}
				}

				foreach (json_decode($item->images, true) as $image) {
					unlink(public_path($image));
				}
			}

			$item->user_id = auth()->user()->id;
			$item->name = $request->name;
			$item->find_date = date('Y-m-d H:i:s', strtotime($request->find_date));
			$item->item_type_id = $request->item_type_id;
			$item->model = $request->model;
			$item->description = $request->description;
			$item->tag = $request->tag;
			$item->color = $request->color;
			$item->location_id = $request->location_id;
			$item->province_id = $request->province_id;
			$item->regency_id = $request->regency_id;
			$item->district_id = $request->district_id;
			$item->village_id = $request->village_id;
			$item->specific_location = $request->specific_location;
			if (isset($saved_images) && count($saved_images) > 0) {
				$item->images = json_encode($saved_images);
			}
			$item->save();
			return redirect('dashboard/find-item')->with('notification', $this->flash_notif('Item berhasil diupdate'));
		}
		$provinces = DB::table('provinces')->get();
		$locations = DB::table('locations')->get();
		$item_types = DB::table('item_types')->get();
		return view("dashboard.edit_find_item", ['active_menu' => 'find-item', 'item' => $item, 'provinces' => $provinces, 'locations' => $locations, 'item_types' => $item_types]);
	}

	public function delete_item($itemId){
		$item = Item::where('id', $itemId)->where('user_id', auth()->user()->id)->first();
		if ($item) {
			foreach (json_decode($item->images, true) as $img) {
				if (file_exists(public_path($img))) {
					unlink(public_path($img));
				}
			}
			$item->delete();
			return redirect(url()->previous())->with('notification', $this->flash_notif('Item Berhasil Dihapus'));
		}
		return redirect(url()->previous())->with('notification', $this->flash_notif('Item tidak ditemukan', 'error'));
	}

	public function search_saved(Request $request){
		if ($request->isMethod('POST')) {
			$items = DB::table('saved_searches')->select('id','query','created_at')->where('user_id', auth()->user()->id)->get();
			if (count($items) <= 0) {
				return '<div class="alert alert-info"><i class="fa fa-info-circle"></i> Tidak ada pencarian yang disimpan</div>';
			}
			$queries = [];
			foreach ($items as $i) {
				foreach (json_decode($i->query, true) as $q) {
					$queries[$i->id][$q['name']] = $q['value'];
				}
			}

			$html = '';
			foreach ($queries as $id => $qwr) {
				$link = '?';
				$keyword = '-';
				$wilayah = '';
				$location = '-';
				$date = '-';
				if (isset($qwr['keyword'])) {
					$link .= 'keyword='.$qwr['keyword'].'&';
					$keyword = $qwr['keyword'];
				}
				if (isset($qwr['village_id'])) {
					$link .= 'village_id='.$qwr['village_id'].'&';
					$wilayah .= DB::table('villages')->select('name')->where('id', $qwr['village_id'])->first()->name .', ';
				}
				if (isset($qwr['district_id'])) {
					$link .= 'district_id='.$qwr['district_id'].'&';
					$wilayah .= DB::table('districts')->select('name')->where('id', $qwr['district_id'])->first()->name .', ';
				}
				if (isset($qwr['regency_id'])) {
					$link .= 'regency_id='.$qwr['regency_id'].'&';
					$wilayah .= DB::table('regencies')->select('name')->where('id', $qwr['regency_id'])->first()->name .', ';
				}
				if (isset($qwr['province_id'])) {
					$link .= 'province_id='.$qwr['province_id'].'&';
					$wilayah .= DB::table('provinces')->select('name')->where('id', $qwr['province_id'])->first()->name;
				}
				if (isset($qwr['date'])) {
					$link .= 'date='.$qwr['date'].'&';
					$date = date('d-M-Y', strtotime($qwr['date']));
				}
				if (isset($qwr['location_id'])) {
					$link .= 'location_id='.$qwr['location_id'];
					$location = DB::table('locations')->select('name')->where('id', $qwr['location_id'])->first()->name;
				}
				$html .= '<div class="card">';
				$html .= '<div class="card-body">';
				$html .= '<p class="fw-bold m-0">Keyword : '.$keyword.'</p>';
				$html .= '<div class="d-flex justify-content-start gap-3">';
				$html .= '<p class="m-0"><i class="fa fa-calendar"></i> '.$date.'</p>';
				$html .= '<p class="m-0"><i class="fa fa-home"></i> '.$location.'</p>';
				$html .= '</div>';
				$html .= '<p class="m-0"><i class="fa fa-map-marker"></i> '.$wilayah.'</p>';
				$html .= '</div>';
				$html .= '<div class="card-footer">';
				$html .= '<div class="d-flex justify-content-start gap-3">';
				$html .= '<a href="'.url('search'.$link).'" target="_blank"><i class="fa fa-info-circle"></i> Tampilkan Hasil</a>';
				$html .= '<a href="javascript:void(0);" onclick="if(confirm(\'Hapus pencarian '.$keyword.' ?\')) { event.preventDefault(); document.getElementById(\'delete-item-'.$id.'\').submit(); }"><i class="fa fa-trash"></i> Hapus</a>';
				$html .= '<form method="POST" id="delete-item-'.$id.'" action="'.url('dashboard/delete-search-saved/'.$id).'" class="d-inline"><input type="hidden" name="_token" value="'.csrf_token().'" /><input type="hidden" value="DELETE" name="_method"></form>';
				$html .= '</div>';
				$html .= '</div>';
				$html .= '</div> ';
			}
			return $html;
		}
		return view("dashboard.search_saved", ['active_menu' => 'search-saved']);
	}

	public function delete_search_saved($itemId){
		$item = SavedSearch::where('id', $itemId)->where('user_id', auth()->user()->id)->delete();
		return redirect(url()->previous())->with('notification', $this->flash_notif('Pencarian Berhasil Dihapus'));
	}

	public function ajax_search_my_items($offset, $limit) {
		$html = '';
		$items = DB::table('items')->join('locations', 'locations.id', '=', 'items.location_id')->leftJoin('provinces', 'items.province_id', '=', 'provinces.id')->leftJoin('regencies', 'items.regency_id', '=', 'regencies.id')->leftJoin('districts', 'items.district_id', '=', 'districts.id')->leftJoin('villages', 'items.village_id', '=', 'villages.id')->select('items.*','locations.name as location','provinces.name as province_name', 'regencies.name as regency_name', 'districts.name as district_name', 'villages.name as village_name')->whereNotNull($_POST['search_type']);
		if (isset($_POST['keyword']) && $_POST['keyword'] != '') {
			$items->where('items.name', 'like', '%'.$_POST['keyword'].'%');
		}
		if (isset($_POST['date']) && $_POST['date'] != '') {
			$items->whereDate($_POST['search_type'], date('Y-m-d', strtotime($_POST['date'])));
		}
		if (isset($_POST['province_id']) && $_POST['province_id'] != '') {
			$items->where('items.province_id', $_POST['province_id']);
		}
		if (isset($_POST['regency_id']) && $_POST['regency_id'] != '') {
			$items->where('items.regency_id', $_POST['regency_id']);
		}
		if (isset($_POST['district_id']) && $_POST['district_id'] != '') {
			$items->where('items.district_id', $_POST['district_id']);
		}
		if (isset($_POST['village_id']) && $_POST['village_id'] != '') {
			$items->where('items.village_id', $_POST['village_id']);
		}
		if (isset($_POST['sort_by']) && $_POST['sort_by'] != '') {
			$items->orderBy($_POST['search_type'], $_POST['sort_by']);
		} else {
			$items->orderBy($_POST['search_type'], 'desc');
		}
		$items = $items->offset($offset)->limit($limit)->get();
		// $this->debug($items);die;
		if (count($items) > 0) {
			$location = '';
			foreach ($items as $i) {
				if ($i->village_name != '') {
					$location .= $i->village_name.', ';
				}
				if ($i->district_name != '') {
					$location .= $i->district_name.', ';
				}
				if ($i->regency_name != '') {
					$location .= $i->regency_name.', ';
				}
				if ($i->province_name != '') {
					$location .= $i->province_name;
				}
				$html .= '<div class="card">';
				$html .= '<div class="card-body">';
				$html .= '<p class="fw-bold m-0">'.$i->name.'</p>';
				$html .= '<div class="d-flex justify-content-start gap-3">';
				$html .= '<p class="m-0">Model : '.$i->model.'</p>';
				$html .= '<p class="m-0">Warna : '.$i->color.'</p>';
				$html .= '</div>';
				$html .= '<div class="d-flex justify-content-start gap-3">';
				$html .= '<p class="m-0"><i class="fa fa-calendar"></i> '.date('d-M-Y', strtotime($i->{$_POST['search_type']})).'</p>';
				$html .= '<p class="m-0"><i class="fa fa-map-marker"></i> '.$location.'</p>';
				$html .= '</div>';
				$html .= '<div class="d-flex justify-content-start gap-3">';
				$html .= '<p class="m-0"><i class="fa fa-map-marker"></i> '.$i->location.'</p>';
				$html .= '<p class="m-0"><i class="fa fa-info-circle"></i> '.$i->specific_location.'</p>';
				$html .= '</div>';
				$html .= '</div>';
				$html .= '<div class="card-footer">';
				$html .= '<div class="d-flex justify-content-start gap-3">';
				$html .= '<a href="'.url('dashboard/lost-item/'.$i->id.'/edit').'"><i class="fa fa-edit"></i> Edit</a>';
				$html .= '<a href="'.url('dashboard/lost-item/'.$i->id.'/edit').'"><i class="fa fa-upload"></i> Upload Gambar</a>';
				$html .= '<a href="javascript:void(0);" onclick="if(confirm(\'Hapus '.$i->name.' ?\')) { event.preventDefault(); document.getElementById(\'delete-item-'.$i->id.'\').submit(); }"><i class="fa fa-trash"></i> Hapus</a>';
				$html .= '<form method="POST" id="delete-item-'.$i->id.'" action="'.url('dashboard/delete-item/'.$i->id).'" class="d-inline"><input type="hidden" name="_token" value="'.csrf_token().'" /><input type="hidden" value="DELETE" name="_method"></form>';
				$html .= '</div>';
				$html .= '</div>';
				$html .= '</div>';
			}
		} else {
			$html .= '<div class="alert alert-info"><i class="fa fa-info-circle"></i> Tidak ada data barang hilang</div>';
		}
		return response()->json(['success' => true, 'html' => $html]);
	}
}
