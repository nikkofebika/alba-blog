<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {
	public function index(){
		$users = DB::table('users')->count();
		$posts = DB::table('posts')->count();
		$facilities = DB::table('facilities')->count();
		$rooms = DB::table('rooms')->count();
		return view('console.dashboard.index', ['page_title' => 'Dashboard', 'active_menu' => 'dashboard', 'users' => $users, 'posts' => $posts, 'facilities' => $facilities, 'rooms' => $rooms]);
	}
}
