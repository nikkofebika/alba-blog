<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Tag;

class TagController extends Controller {
	public function index(){
		$tags = Tag::all();
		return view('console.tags.index', ['page_title' => 'Tag', 'active_menu' => 'tags', 'tags' => $tags]);
	}

	public function show($id) {
		$tag = DB::table('tags')->select('name')->where('id', $id)->first();
		if (!$tag) {
			return ['success'=>false];
		}
		return ['success'=>true,'tag'=>$tag];
	}

	public function ajax_cek_tag() {
		$tag = DB::table('tags')->where('title', trim($_POST['title']));
		if (isset($_POST['id']) && $_POST['id'] != '') {
			$tag->where('id', '!=', $_POST['id']);
		}
		$tag = $tag->first();
		if ($tag) {
			return ['success'=>false];
		}
		return ['success'=>true];
	}

	public function ajax_get_tags() {
		$tag = DB::table('tags')->select('id', 'title as text');
		if (isset($_GET['search']) && $_GET['search'] != '') {
			$tag->where('title', 'like', '%'.$_GET['search'].'%');
		}
		return $tag->get();
	}

	public function store(Request $request) {
		$arrValidator = [];
		if ($request->has('id')) {
			$tag = Tag::findOrFail($request->id);
			$arrValidator = [
				'title' => 'required|unique:tags,title,'.$request->id,
			];
			$msg = 'Tag berhasil diupdate';
		} else {
			$tag = new Tag;
			$arrValidator = [
				'title' => 'required|unique:tags,title',
			];
			$msg = 'Tag berhasil ditambahkan';
		}

		$validator = Validator::make($request->all(), $arrValidator);

		if ($validator->fails()) {
			$errMsg = '<ul>';
			foreach ($validator->errors()->all() as $e) {
				$errMsg .= '<li>'.$e.'</li>';
			}
			$errMsg .= '<ul>';
			return redirect('console/tags')->with('notification', $this->flash_data('error', 'Gagal', $errMsg));
		}
		
		$tag->title = trim($request->title);
		$tag->seo_title = Str::slug($tag->title, '-');
		$tag->save();
		return redirect('console/tags')->with('notification', $this->flash_data('success', 'Berhasil', $msg));
	}

	public function destroy($id){
		$tag = Tag::findOrFail($id);
		if (!$tag) {
			return redirect('console/tags')->with('notification', $this->flash_data('error', 'Gagal', 'Tag tidak ditemukan'));
		}

		\App\Models\PostTag::where('tag_id', $id)->delete();
		$tag->delete();

		return redirect('console/tags')->with('notification', $this->flash_data('success', 'Berhasil', 'Tag berhasil dihapus'));
	}
}
