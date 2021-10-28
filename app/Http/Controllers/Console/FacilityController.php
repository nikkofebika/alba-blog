<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use DataTables;

class FacilityController extends Controller {
    public function index() {
        return view('console.facilities.index', ['page_title' => 'Facilities', 'active_menu' => 'facilities']);
    }

    public function getFacilities(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('facilities')->select(['id','name','url','image','priority','is_active'])->orderBy('priority', 'asc')->orderBy('updated_at', 'desc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('url', function($data) {return '<a href="'.$data->url.'" target="_blank">'.$data->url.'</a>';})
            ->editColumn('image', function($data) {return '<a href="'.asset($data->image).'" target="_blank"><img src="'.asset($data->image).'" width="80"/></a>';})
            ->editColumn('is_active', function($data) {
                $checked = $data->is_active == 1 ? 'checked' : '';
                return '<input type="checkbox" '.$checked.' class="check_active" data-facility_id="'.$data->id.'" />';
            })
            ->addColumn('action', function($data){
                return '<a href="'.route('console.facilities.edit', $data->id).'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></a> <form method="POST" onsubmit="return confirm(\'Hapus '.$data->name.' ?\')" action="'.route("console.facilities.destroy", $data->id).'" class="d-inline"><input type="hidden" name="_token" value="'.csrf_token().'" /><input type="hidden" value="DELETE" name="_method"><button type="submit" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></button></form>';
            })
            ->escapeColumns([])
            ->make(true);
        }
    }

    public function create() {
        return view('console.facilities.create', ['page_title' => 'Facilities - Tambah Data', 'active_menu' => 'facilities']);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:facilities',
            'url' => 'required|url',
            'priority' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:100',
        ]);

        if ($request->image->isValid()) {
            $imageName = Str::slug($request->name, '-').'-'.time().'.'.$request->image->extension();
            $dir = '/images/facilities/';
            if (!file_exists(public_path($dir))) {
                mkdir(public_path($dir), 0777, true);
                chmod(public_path($dir), 0777);
            }
            $request->image->move(public_path($dir), $imageName);
        }

        $facility = new Facility;
        $facility->name = trim($request->name);
        $facility->url = trim($request->url);
        $facility->priority = $request->priority;
        $facility->image = $dir.$imageName;
        $facility->save();
        return redirect('console/facilities')->with('notification', $this->flash_data('success', 'Berhasil', 'Fasilitas Berhasil Ditambahkan'));
    }

    public function edit($id) {
        $facility = Facility::findOrFail($id);
        return view('console.facilities.edit',['facility' => $facility, 'page_title' => 'Facilities - Edit Data', 'active_menu' => 'facilities']);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|unique:facilities,name,'.$id,
            'url' => 'required|url',
            'priority' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:100',
        ]);
        $facility = Facility::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($request->image->isValid()) {
                $imageName = Str::slug($request->name, '-').'-'.time().'.'.$request->image->extension();
                $dir = '/images/facilities/';
                if (!file_exists(public_path($dir))) {
                    mkdir(public_path($dir), 0777, true);
                    chmod(public_path($dir), 0777);
                }
                unlink(public_path($facility->image));
                $request->image->move(public_path($dir), $imageName);
            }
        }

        $facility->name = trim($request->name);
        $facility->url = trim($request->url);
        $facility->priority = $request->priority;
        if ($request->hasFile('image')) {
            $facility->image = $dir.$imageName;
        }
        $facility->save();
        return redirect('console/facilities')->with('notification', $this->flash_data('success', 'Berhasil', 'Fasilitas Berhasil Diupdate'));
    }

    public function destroy($id) {
        $facility = Facility::findOrFail($id);
        unlink(public_path($facility->image));
        $facility->delete();
        return redirect('console/facilities')->with('notification', $this->flash_data('success', 'Berhasil', 'Fasilitas Berhasil Dihapus'));
    }

    public function ajax_active_facility(Request $request) {
        if ($request->ajax()) {
            if (DB::table('facilities')->where('id', $_POST['facility_id'])->update(["is_active" => $_POST['val']])) {
                if ($_POST['val'] == 1) {
                    return ['success'=>true, 'message'=> 'Fasilitas Aktif'];
                }
                return ['success'=>false, 'message'=> 'Fasilitas Nonaktif'];
            }
            return ['success'=>false, 'message'=> 'Fasilitas Nonaktif'];
        }
    }
}
