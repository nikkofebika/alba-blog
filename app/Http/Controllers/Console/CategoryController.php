<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryController extends Controller {
	public function index(){
		$categories = Category::orderBy('priority', 'asc')->orderBy('updated_at', 'desc')->get();
		return view('console.categories.index', ['page_title' => 'Category', 'active_menu' => 'categories', 'categories' => $categories]);
	}

	public function show($id) {
		$category = DB::table('categories')->select('name')->where('id', $id)->first();
		if (!$category) {
			return ['success'=>false];
		}
		return ['success'=>true,'category'=>$category];
	}

	public function ajax_cek_category() {
		$category = DB::table('categories')->where('title', trim($_POST['title']));
		if (isset($_POST['id']) && $_POST['id'] != '') {
			$category->where('id', '!=', $_POST['id']);
		}
		$category = $category->first();
		if ($category) {
			return ['success'=>false];
		}
		return ['success'=>true];
	}

	public function store(Request $request) {
		$arrValidator = [];
		if ($request->has('id')) {
			$category = Category::findOrFail($request->id);
			$arrValidator = [
				'title' => 'required|unique:categories,title,'.$request->id,
				'priority' => 'required|numeric',
			];
			$msg = 'Kategori berhasil diupdate';
		} else {
			$category = new Category;
			$arrValidator = [
				'title' => 'required|unique:categories,title',
				'priority' => 'required|numeric',
			];
			$msg = 'Kategori berhasil ditambahkan';
		}

		$validator = Validator::make($request->all(), $arrValidator);

		if ($validator->fails()) {
			$errMsg = '<ul>';
			foreach ($validator->errors()->all() as $e) {
				$errMsg .= '<li>'.$e.'</li>';
			}
			$errMsg .= '<ul>';
			return redirect('console/categories')->with('notification', $this->flash_data('error', 'Gagal', $errMsg));
		}
		
		$category->title = trim($request->title);
		$category->seo_title = Str::slug($category->title, '-');
		$category->priority = $request->priority;
		$category->save();
		cache()->forget('categories');
		cache()->rememberForever('categories', function () {
			return DB::table('categories')->select('id','title','seo_title')->whereNotNull('approved_by')->orderBy('priority', 'asc')->orderBy('updated_at', 'desc')->get();
		});
		return redirect('console/categories')->with('notification', $this->flash_data('success', 'Berhasil', $msg));
	}

	// public function update(Request $request, $id) {
	// 	$request->validate([
	// 		'title' => 'required|unique:categories,title'.$id,
	// 		'priority' => 'required|numeric',
	// 	]);

	// 	$category = Category::findOrFail($id);
	// 	$category->title = $request->title;
	// 	$category->seo_title = Str::slug($category->title, '-');
	// 	$category->priority = $request->priority;
	// 	$category->save();
	// 	return redirect('console/categories')->with('notification', $this->flash_data('success', 'Berhasil', 'Kategori berhasil diupdate'));
	// }

	public function destroy($id){
		$c = Category::findOrFail($id)->delete();
		return redirect('console/categories')->with('notification', $this->flash_data('success', 'Berhasil', 'Kategori berhasil dihapus'));
	}

	public function ajax_active_category(Request $request) {
		if ($request->ajax()) {
			if ($_POST['val'] == 1) {
				DB::table('categories')->where('id', $request->category_id)->update(["approved_by" => auth()->user()->id]);
				$success = true;
				$message = 'Kategori Aktif';
			} else {
				DB::table('categories')->where('id', $request->category_id)->update(["approved_by" => null]);
				$success = false;
				$message = 'Kategori Nonaktif';
			}
			cache()->forget('CATEGORIES');
			cache()->rememberForever('CATEGORIES', function () {
				return DB::table('categories')->select('id','title','seo_title')->whereNotNull('approved_by')->orderBy('priority', 'asc')->orderBy('updated_at', 'desc')->get();
			});
			return ['success'=>$success, 'message'=> $message];
		}
	}
}
