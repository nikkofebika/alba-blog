<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BulletinController extends Controller {
    protected $categories;
    protected $recent_bulletins;

    public function __construct() {
        $this->categories = cache()->get('ARTICLE_CATEGORIES', function () {
            $cats = DB::table('article_categories')->select('id','title','seo_title')->whereNotNull('approved_by')->orderBy('priority', 'asc')->orderBy('updated_at', 'desc')->get();
            cache()->forever('ARTICLE_CATEGORIES', $cats);
            return $cats;
        });
        $this->recent_bulletins = DB::table('articles')->join('article_categories', 'articles.article_category_id', '=', 'article_categories.id')->select('article_categories.seo_title as seo_category','articles.title','articles.seo_title','articles.description','articles.image','articles.published_at')->where('articles.published_at', '<=', NOW())->whereNotNull('articles.approved_by')->orderBy('articles.published_at', 'desc')->limit(5)->get();
    }

    public function index($seo_category = null) {
        $seo_category = trim($seo_category);
        $join_category = false;
        $category_id = 0;
        if ($seo_category != null) {
            $category = DB::table('article_categories')->select('id')->where('seo_title',$seo_category)->whereNotNull('approved_by')->first();
            if ($category) {
                $join_category = true;
                $category_id = $category->id;
            }
        }

        $bulletins = DB::table('articles')->join('article_categories', 'articles.article_category_id', '=', 'article_categories.id')->select('article_categories.seo_title as seo_category','articles.title','articles.seo_title','articles.image','articles.published_at',DB::raw('substr(articles.description, 1, 250) as description'));
        if (isset($_GET['q']) && $_GET['q'] != '') {
            $bulletins->where('articles.title', 'like', '%'.$_GET['q'].'%');
        }
        if ($join_category) {
            $bulletins->where('articles.article_category_id', $category->id);
        }
        $bulletins = $bulletins->where('articles.published_at', '<=', NOW())->whereNotNull('articles.approved_by')->orderBy('articles.published_at','desc')->limit(10)->get();

        return view('bulletin.index', ['active_menu' => 'bulletin','categories' => $this->categories, 'seo_category' => $seo_category, 'category_id' => $category_id, 'bulletins' => $bulletins, 'recent_bulletins' => $this->recent_bulletins]);
    }

    public function detail_bulletin($seo_category, $seo_title) {
        $bulletin = DB::table('articles')->join('article_categories', 'articles.article_category_id', '=', 'article_categories.id')->select('articles.article_category_id','article_categories.seo_title as seo_category','articles.title','articles.seo_title','articles.image','articles.published_at','articles.description')->where('articles.seo_title', $seo_title)->where('articles.published_at', '<=', NOW())->whereNotNull('articles.approved_by')->first();
        return view('bulletin.detail_bulletin', ['active_menu' => 'bulletin', 'categories' => $this->categories, 'recent_bulletins' => $this->recent_bulletins, 'bulletin' => $bulletin, 'category_id' => $bulletin->article_category_id]);
    }

    public function ajax_load_more($offset, $category_id = null) {
        $bulletins = DB::table('articles')->join('article_categories', 'articles.article_category_id', '=', 'article_categories.id')->select('article_categories.seo_title as seo_category','articles.title','articles.seo_title','articles.image','articles.published_at',DB::raw('substr(articles.description, 1, 250) as description'))->where('articles.published_at', '<=', NOW())->whereNotNull('articles.approved_by');
        if (isset($_GET['q']) && $_GET['q'] != '') {
            $bulletins->where('articles.title', 'like', '%'.$_GET['q'].'%');
        }
        if ($category_id != null && $category_id != 0) {
            $bulletins->where('articles.article_category_id', $category_id);
        }
        $bulletins = $bulletins->orderBy('articles.published_at','desc')->offset($offset)->limit(10)->get();

        $html = '';
        if (count($bulletins) > 0) {
            foreach ($bulletins as $b) {
                $html .= '<article class="entry">';
                $html .= '<div class="entry-img">';
                $html .= '<img src="'.asset($b->image).'" alt="'.$b->title.'" class="img-fluid">';
                $html .= '</div>';
                $html .= '<h2 class="entry-title">';
                $html .= '<a href="'.url('bulletin/'.$b->seo_title).'">'.$b->title.'</a>';
                $html .= '</h2>';
                $html .= '<div class="entry-meta">';
                $html .= '<ul>';
                $html .= '<li class="d-flex align-items-center"><i class="bi bi-clock"></i> <time datetime="'.date('d-M-Y, H:i', strtotime($b->published_at)).'">'.date('d-M-Y H:i', strtotime($b->published_at)).'</time></li>';
                $html .= '</ul>';
                $html .= '</div>';
                $html .= '<div class="entry-content">';
                $html .= '<p>'.strip_tags($b->description).'...</p>';
                $html .= '<div class="read-more">';
                $html .= '<a href="'.url('bulletin/'.$b->seo_title).'">Read More</a>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</article>';
            }
            return ['success' => true, 'html' => $html];
        }
        return ['success' => false, 'html' => $html];
    }
}
