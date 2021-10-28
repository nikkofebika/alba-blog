<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use DataTables;

class PostController extends Controller {
	public function index() {
		return view('console.posts.index', ['page_title' => 'Post', 'active_menu' => 'posts']);
	}

	public function getPosts(Request $request) {
		if ($request->ajax()) {
			$data = Post::select(['id','title','image','approved_by','is_slider','published_at','created_at'])->orderBy('created_at', 'desc')->get();
			return Datatables::of($data)
			->addIndexColumn()
			->editColumn('image', function($data) {return '<a href="'.asset($data->image).'" target="_blank"><img src="'.asset($data->image).'" width="100"/></a>';})
			->editColumn('published_at', function($data) {return date('d-m-Y H:i', strtotime($data->published_at));})
			->editColumn('is_slider', function($data) {return $data->is_slider == 1 ? '<span class="label label-success">Slider</span>' : '';})
			->editColumn('approved_by', function($data) {
				$checked = $data->approved_by != null ? 'checked' : '';
				return '<input type="checkbox" '.$checked.' class="check_approve" data-post_id="'.$data->id.'" />';
			})
			->addColumn('action', function($data){
				return '<a href="'.url('console/posts/'.$data->id).'" class="btn btn-info btn-xs" title="Detail"><i class="fa fa-eye"></i></a> <a href="'.route('console.posts.edit', $data->id).'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></a> <form method="POST" onsubmit="return confirm(\'Hapus '.$data->title.' ?\')" action="'.route("console.posts.destroy", $data->id).'" class="d-inline"><input type="hidden" name="_token" value="'.csrf_token().'" /><input type="hidden" value="DELETE" name="_method"><button type="submit" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></button></form>';
			})
			->escapeColumns([])
			->make(true);
		}
	}

	public function create() {
		$categories = DB::table('categories')->select('id','title')->whereNotNull('approved_by')->get();
		return view('console.posts.create', ['page_title' => 'Post - Tambah Data', 'active_menu' => 'posts', 'categories' => $categories]);
	}

	public function store(Request $request) {
		$request->validate([
			'title' => 'required|unique:posts',
			'category_id' => 'required',
			'is_slider' => 'required',
			'description' => 'required',
			'published_at' => 'required',
			'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:512',
		]);

		if ($request->image->isValid()) {
			$imageName = Str::slug($request->title, '-').'-'.time().'.'.$request->image->extension();
			$dir = '/images/posts/';
			if (!file_exists(public_path($dir))) {
				mkdir(public_path($dir), 0777, true);
				chmod(public_path($dir), 0777);
			}
			$request->image->move(public_path($dir), $imageName);
		}

		$post = new Post;
		$post->user_id = auth()->user()->id;
		$post->category_id = $request->category_id;
		$post->title = trim($request->title);
		$post->seo_title = Str::slug($post->title, '-');
		$post->description = trim($request->description);
		$post->is_slider = $request->is_slider;
		$post->image = $dir.$imageName;
		$post->published_at = date('Y-m-d H:i:s', strtotime($request->published_at));
		if ($post->save()) {
			if ($request->has('tags') && count($request->tags) > 0) {
				foreach ($request->tags as $tag) {
					PostTag::create([
						'post_id' => $post->id,
						'tag_id' => $tag,
					]);
				}
			}
			return redirect('console/posts')->with('notification', $this->flash_data('success', 'Success', 'Post berhasil disimpan'));
		}
		return redirect('console/posts')->with('notification', $this->flash_data('error', 'Gagal', 'Gagal menyimpan post'));
	}

	public function show($id) {
		$post = Post::findOrFail($id);
		return view('console.posts.show', ['post'=>$post, 'active_menu' => 'posts']);
	}

	public function edit($id) {
		$post = Post::findOrFail($id);
		$categories = DB::table('categories')->select('id','title')->whereNotNull('approved_by')->get();
		return view('console.posts.edit',['post' => $post, 'categories' => $categories, 'page_title' => 'Post - Edit Data', 'active_menu' => 'posts']);
	}

	public function update(Request $request, $id) {
		$request->validate([
			'title' => 'required|unique:posts,title,'.$id,
			'category_id' => 'required',
			'is_slider' => 'required',
			'description' => 'required',
			'image' => 'image|mimes:jpeg,png,jpg,svg|max:512',
			'published_at' => 'required',
		]);

		$post = Post::findOrFail($id);
		if ($request->hasFile('image')) {
			if ($request->image->isValid()) {
				$imageName = Str::slug($request->title, '-').'-'.time().'.'.$request->image->extension();
				$dir = '/images/posts/';
				if (!file_exists(public_path($dir))) {
					mkdir(public_path($dir), 0777, true);
					chmod(public_path($dir), 0777);
				}
				if (file_exists(public_path($post->image))) {
					unlink(public_path($post->image));
				}
				$request->image->move(public_path($dir), $imageName);
			}
		}

		$post->category_id = $request->category_id;
		$post->title = trim($request->title);
		$post->seo_title = Str::slug($post->title, '-');
		$post->description = $request->description;
		$post->is_slider = $request->is_slider;
		if ($request->hasFile('image')) {
			$post->image = $dir.$imageName;
		}
		$post->published_at = date('Y-m-d H:i:s', strtotime($request->published_at));
		$post->save();
		if ($post->save()) {
			if ($request->has('tags') && count($request->tags) > 0) {
				PostTag::where('post_id', $post->id)->delete();
				foreach ($request->tags as $tag) {
					PostTag::create([
						'post_id' => $post->id,
						'tag_id' => $tag,
					]);
				}
			}
			return redirect('console/posts')->with('notification', $this->flash_data('success', 'Success', 'Post berhasil diupdate'));
		}
		return redirect('console/posts')->with('notification', $this->flash_data('error', 'Gagal', 'Post gagal diupdate'));
	}

	public function destroy($id) {
		$post = Post::findOrFail($id);
		if (pathinfo($post->image, PATHINFO_FILENAME) !== 'sample') {
			unlink(public_path($post->image));
		}
		$post->delete();
		return redirect('console/posts')->with('notification', $this->flash_data('success', 'Success', 'Post berhasil dihapus'));
	}

	public function ajax_approve_post(Request $request) {
		if ($request->ajax()) {
			if ($request->val == 1) {
				DB::table('posts')->where('id', $request->post_id)->update(["approved_by" => auth()->user()->id]);
				return ['success'=>true, 'message'=> 'Post Approved'];
			} else {
				DB::table('posts')->where('id', $request->post_id)->update(["approved_by" => null]);
				return ['success'=>false, 'message'=> 'Post Unapproved'];
			}
		}
		return ['success'=>false, 'message'=> 'Post Unapproved'];
	}
}
