<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);
Route::get('console', function(){
	return redirect('console/login');
});
Auth::routes();

Route::group(['prefix' => 'console', 'as' => 'console.', 'middleware' => 'auth'], function () {
	Route::post('logout', [App\Http\Controllers\Console\AuthController::class, 'logout']);
	Route::get('/', [App\Http\Controllers\Console\DashboardController::class, 'index']);
	Route::get('dashboard', [App\Http\Controllers\Console\DashboardController::class, 'index']);

	Route::get('users/list', [App\Http\Controllers\Console\UserController::class, 'getUsers'])->name('users.list');
	Route::post('users/ajax_active_user', [App\Http\Controllers\Console\UserController::class, 'ajax_active_user']);

	Route::get('posts/list', [App\Http\Controllers\Console\PostController::class, 'getposts'])->name('posts.list');
	Route::post('posts/ajax_approve_post', [App\Http\Controllers\Console\PostController::class, 'ajax_approve_post']);

	Route::get('categories', [App\Http\Controllers\Console\CategoryController::class, 'index']);
	Route::post('categories/ajax_cek_category', [App\Http\Controllers\Console\CategoryController::class, 'ajax_cek_category']);
	Route::post('categories/ajax_active_category', [App\Http\Controllers\Console\CategoryController::class, 'ajax_active_category']);
	Route::get('categories/{id}', [App\Http\Controllers\Console\CategoryController::class, 'show']);
	Route::post('categories', [App\Http\Controllers\Console\CategoryController::class, 'store']);
	Route::put('categories/{id}', [App\Http\Controllers\Console\CategoryController::class, 'update']);
	Route::delete('categories/destroy/{id}', [App\Http\Controllers\Console\CategoryController::class, 'destroy']);

	Route::post('tags/ajax_cek_tag', [App\Http\Controllers\Console\TagController::class, 'ajax_cek_tag']);
	Route::get('tags/ajax_get_tags', [App\Http\Controllers\Console\TagController::class, 'ajax_get_tags']);

	Route::resources([
		'users' => App\Http\Controllers\Console\UserController::class,
		'posts' => App\Http\Controllers\Console\PostController::class,
		'tags' => App\Http\Controllers\Console\TagController::class,
	]);
});

Route::get('ajax_load_more/{offset}/{category_id?}', [App\Http\Controllers\IndexController::class, 'ajax_load_more']);
Route::get('{seo_category?}', [App\Http\Controllers\IndexController::class, 'index']);
Route::get('{seo_category}/{seo_title}', [App\Http\Controllers\IndexController::class, 'detail_post']);