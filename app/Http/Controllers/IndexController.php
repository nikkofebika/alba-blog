<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller {
    public function index() {
        $articles = DB::table('articles')->join('article_categories', 'articles.article_category_id', '=', 'article_categories.id')->select('article_categories.seo_title as seo_category','articles.title','articles.seo_title','articles.image', DB::raw('substr(articles.description, 1, 250) as description'))->where('articles.is_slider', 1)->whereNotNull('articles.approved_by')->whereDate('articles.published_at','<=', NOW())->get();
        if (auth()->check()) {
            $teams = DB::table('teams')->select('name','position','image','socmed')->whereNotNull('approved_by')->orderBy('priority', 'asc')->orderBy('updated_at', 'desc')->get();
            return view('index', ['active_menu' => 'home', 'articles' => $articles, 'teams' => $teams]);
        }
        return view('index', ['active_menu' => 'home', 'articles' => $articles]);
    }

    public function company_policy() {
        $policies = DB::table('company_policies')->select('id','title','description','file')->whereNotNull('approved_by')->orderBy('priority', 'asc')->orderBy('updated_at', 'desc')->get();
        $titles = [];
        $descriptions = [];
        foreach ($policies as $p) {
            $titles[] = $p->title;
            $descriptions[] = ['description' => $p->description, 'file' => $p->file];
        }
        return view('company_policy', ['active_menu' => 'company-policy', 'titles' => $titles, 'descriptions' => $descriptions]);
    }

    public function forgot_password() {
        return view('forgot_password', ['active_menu' => 'forgot_password']);
    }

    public function facilities() {
        $facilities = DB::table('facilities')->select('name','url','image')->where('is_active', 1)->orderBy('priority', 'asc')->orderBy('updated_at', 'desc')->get();
        return view('facilities', ['active_menu' => 'facilities', 'facilities' => $facilities]);
    }

    public function calendar() {
        return view('calendar', ['active_menu' => 'calendar']);
    }

    public function kalender() {
        return view('kalender', ['active_menu' => 'kalender']);
    }

    public function bulletin() {
        $bulletins = DB::table('articles')->select('title','seo_title','description','image','published_at','created_by')->where('published_at', '<=', NOW())->whereNotNull('approved_by')->paginate(15);
        $recent_bulletins = DB::table('articles')->select('title','seo_title','description','image','published_at','created_by')->where('published_at', '<=', NOW())->whereNotNull('approved_by')->orderBy('published_at', 'desc')->limit(5)->get();
        return view('bulletin', ['bulletins' => $bulletins, 'recent_bulletins' => $recent_bulletins, 'active_menu' => 'bulletin']);
    }

    public function detail_bulletin($seo_title) {
        return view('detail_bulletin', ['active_menu' => 'bulletin']);
    }
    
    // public function detail_bulletin($seo_title) {
    // 	$bulletin = DB::table('articles')->select('title','seo_title','description','image','published_at','created_by')->where('seo_title', $seo_title)->where([['published_at', '<=', NOW()], ['approved', 1]])->first();
    //     $recent_bulletins = DB::table('articles')->select('title','seo_title','description','image','published_at','created_by')->where([['published_at', '<=', NOW()], ['approved', 1]])->where('seo_title','!=',$bulletin->seo_title)->orderBy('published_at', 'desc')->limit(5)->get();
    // 	return view('detail_bulletin', ['bulletin' => $bulletin, 'recent_bulletins' => $recent_bulletins, 'active_menu' => 'bulletin']);
    // }
}
