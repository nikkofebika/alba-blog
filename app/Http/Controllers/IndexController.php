<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller {
	protected $categories;

	public function __construct() {
		$this->categories = cache()->get('CATEGORIES', function () {
			$c = DB::table('categories')->select('id','title','seo_title')->whereNotNull('approved_by')->orderBy('priority', 'asc')->orderBy('updated_at', 'desc')->get();
			cache()->forever('CATEGORIES', $c);
			return $c;
		});
	}

	public function index($seo_category = null) {
		$seo_category = trim($seo_category);
		$join_category = false;
		$category_id = 0;
		if ($seo_category != null) {
			$category = DB::table('categories')->select('id')->where('seo_title',$seo_category)->whereNotNull('approved_by')->first();
			if ($category) {
				$join_category = true;
				$category_id = $category->id;
			} else {
				return view('errors.404', ['category_id' => 0, 'categories' => $this->categories]);
			}
		}

		$posts = DB::table('posts')->join('categories', 'posts.category_id', '=', 'categories.id')->join('users', 'posts.user_id', '=', 'users.id')->select('users.name','categories.seo_title as seo_category','categories.title as category_title','posts.title','posts.seo_title','posts.image','posts.published_at','description');
		if (isset($_GET['q']) && $_GET['q'] != '') {
			$posts->where('posts.title', 'like', '%'.$_GET['q'].'%');
		}
		if ($join_category) {
			$posts->where('posts.category_id', $category->id);
		}
		$posts = $posts->whereNotNull('categories.approved_by')->where('posts.published_at', '<=', NOW())->whereNotNull('posts.approved_by')->orderBy('posts.published_at','desc')->limit(5)->get();
		return view('index', ['active_menu' => 'post','categories' => $this->categories, 'seo_category' => $seo_category, 'category_id' => $category_id, 'posts' => $posts]);
	}

	public function detail_post($seo_category, $seo_title) {
		$post = DB::table('posts')->join('categories', 'posts.category_id', '=', 'categories.id')->join('users', 'posts.user_id', '=', 'users.id')->select('users.name','posts.category_id','categories.seo_title as seo_category','categories.title as category_title','posts.id','posts.title','posts.seo_title','posts.image','posts.published_at','posts.description')->where('posts.seo_title', $seo_title)->whereNotNull('categories.approved_by')->where('posts.published_at', '<=', NOW())->whereNotNull('posts.approved_by')->first();
		if (!$post) {
			return view('errors.404', ['category_id' => 0, 'categories' => $this->categories]);
		}
		$tags = DB::table('post_tag')->join('tags', 'post_tag.tag_id', '=', 'tags.id')->select('tags.title')->where('post_tag.post_id', $post->id)->get();
		return view('detail_post', ['active_menu' => 'post', 'categories' => $this->categories, 'post' => $post, 'tags' => $tags, 'category_id' => $post->category_id]);
	}

	public function ajax_load_more($offset, $category_id = null) {
		$posts = DB::table('posts')->join('categories', 'posts.category_id', '=', 'categories.id')->join('users', 'posts.user_id', '=', 'users.id')->select('users.name','categories.seo_title as seo_category','categories.title as category_title','posts.title','posts.seo_title','posts.image','posts.published_at','description')->whereNotNull('categories.approved_by')->where('posts.published_at', '<=', NOW())->whereNotNull('posts.approved_by');
		if (isset($_GET['q']) && $_GET['q'] != '') {
			$posts->where('posts.title', 'like', '%'.$_GET['q'].'%');
		}
		if ($category_id != null && $category_id != 0) {
			$posts->where('posts.category_id', $category_id);
		}
		$posts = $posts->orderBy('posts.published_at','desc')->offset($offset)->limit(5)->get();

		$html = '';
		if (count($posts) > 0) {
			foreach ($posts as $b) {
				$html .= '<post class="entry">';
				$html .= '<div class="entry-img">';
				$html .= '<img src="'.asset($b->image).'" alt="'.$b->title.'" class="img-fluid">';
				$html .= '</div>';
				$html .= '<h2 class="entry-title">';
				$html .= '<a href="'.url('post/'.$b->seo_title).'">'.$b->title.'</a>';
				$html .= '</h2>';
				$html .= '<div class="entry-meta">';
				$html .= '<ul>';
				$html .= '<li class="d-flex align-items-center"><i class="bi bi-clock"></i> <time datetime="'.date('d-M-Y, H:i', strtotime($b->published_at)).'">'.date('d-M-Y H:i', strtotime($b->published_at)).'</time></li>';
				$html .= '<li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-single.html">'.$b->name.'</a></li>';
				$html .= '</ul>';
				$html .= '</div>';
				$html .= '<div class="entry-content">';
				$html .= '<p>'.substr(strip_tags($b->description), 0, 100).'...</p>';
				$html .= '<div class="read-more">';
				$html .= '<a href="'.url('post/'.$b->seo_title).'">Read More</a>';
				$html .= '</div>';
				$html .= '</div>';
				$html .= '</post>';
			}
			return ['success' => true, 'html' => $html];
		}
		return ['success' => false, 'html' => $html];
	}
}
