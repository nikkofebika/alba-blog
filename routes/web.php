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
// Route::get('/login', function () {
// 	return view('welcome');
// });
Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);
Route::get('company-policy', [App\Http\Controllers\IndexController::class, 'company_policy']);
Route::get('facilities', [App\Http\Controllers\IndexController::class, 'facilities']);
Route::get('calendar', [App\Http\Controllers\IndexController::class, 'calendar']);
Route::get('kalender', [App\Http\Controllers\IndexController::class, 'kalender']);
Route::get('login', [App\Http\Controllers\IndexController::class, 'login']);
Route::get('forgot_password', [App\Http\Controllerslers\IndexController::class, 'forgot_password']);

Route::get('bulletin/{seo_category?}', [App\Http\Controllers\BulletinController::class, 'index'])->middleware('auth');
Route::get('bulletin/ajax_load_more/{offset}/{category_id?}', [App\Http\Controllers\BulletinController::class, 'ajax_load_more'])->middleware('auth');
Route::get('bulletin/{seo_category}/{seo_title}', [App\Http\Controllers\BulletinController::class, 'detail_bulletin'])->middleware('auth');

Route::get('console', function(){
	return redirect('console/login');
});
Route::get('/console/login', [App\Http\Controllers\Console\AuthController::class, 'showLoginForm'])->name('console.login');
Route::post('/console/login_admin', [App\Http\Controllers\Console\AuthController::class, 'login']);
Auth::routes();

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
	Route::any('/', [App\Http\Controllers\Dashboard\DashboardController::class, 'personal_identity']);
	Route::get('profile', [App\Http\Controllers\Dashboard\DashboardController::class, 'personal_identity']);
	Route::get('profile/personal-identity', [App\Http\Controllers\Dashboard\DashboardController::class, 'personal_identity']);
	Route::get('profile/education-training', [App\Http\Controllers\Dashboard\DashboardController::class, 'education_training']);
	Route::get('profile/family', [App\Http\Controllers\Dashboard\DashboardController::class, 'family']);
	Route::get('profile/working-experience', [App\Http\Controllers\Dashboard\DashboardController::class, 'working_experience']);

	Route::get('leave-request', [App\Http\Controllers\Dashboard\AttendanceController::class, 'leave_request']);
	Route::get('leave-request/leave-request', [App\Http\Controllers\Dashboard\AttendanceController::class, 'leave_request']);
	Route::get('leave-request/leave-balance', [App\Http\Controllers\Dashboard\AttendanceController::class, 'leave_balance']);
	Route::get('leave-request/leave-approval', [App\Http\Controllers\Dashboard\AttendanceController::class, 'leave_approval']);

	Route::get('room', [App\Http\Controllers\Dashboard\RoomController::class, 'index']);
	Route::get('attendance', [App\Http\Controllers\Dashboard\AttendanceController::class, 'index']);
	Route::get('medical', [App\Http\Controllers\Dashboard\MedicalController::class, 'index']);

	Route::get('room/booking_schedule_list', [App\Http\Controllers\Dashboard\RoomController::class, 'booking_schedule_list']);
	Route::get('room/ajax_load_schedules/{scheduleId?}', [App\Http\Controllers\Dashboard\RoomController::class, 'ajax_load_schedules']);
	Route::post('room/ajax_move_schedule', [App\Http\Controllers\Dashboard\RoomController::class, 'ajax_move_schedule']);
	Route::post('room/ajax_create_booking_schedules', [App\Http\Controllers\Dashboard\RoomController::class, 'ajax_create_booking_schedules']);
	Route::get('room/ajax_get_today_schedules/{roomId}/{date}/{scheduleId?}', [App\Http\Controllers\Dashboard\RoomController::class, 'ajax_get_today_schedules']);
	Route::post('room/ajax_delete_booking_schedules', [App\Http\Controllers\Dashboard\RoomController::class, 'ajax_delete_booking_schedules']);
	
	Route::get('lost-item', [App\Http\Controllers\DashboardController::class, 'lost_item']);
	Route::any('lost-item/{itemId}/edit', [App\Http\Controllers\DashboardController::class, 'edit_lost_item']);
	Route::any('lost-item/create', [App\Http\Controllers\DashboardController::class, 'create_lost_item']);
	
	Route::get('find-item', [App\Http\Controllers\DashboardController::class, 'find_item']);
	Route::any('find-item/{itemId}/edit', [App\Http\Controllers\DashboardController::class, 'edit_find_item']);
	Route::any('find-item/create', [App\Http\Controllers\DashboardController::class, 'create_find_item']);
	
	Route::any('search-saved', [App\Http\Controllers\DashboardController::class, 'search_saved']);
	Route::delete('delete-search-saved/{itemId}', [App\Http\Controllers\DashboardController::class, 'delete_search_saved']);
	
	Route::delete('delete-item/{itemId}', [App\Http\Controllers\DashboardController::class, 'delete_item']);
	Route::post('ajax_search_my_items/{offset}/{limit}', [App\Http\Controllers\DashboardController::class, 'ajax_search_my_items']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'console', 'as' => 'console.', 'middleware' => ['IsAdmin','auth:admin']], function () {
	Route::post('logout', [App\Http\Controllers\Console\AuthController::class, 'logout']);
	Route::get('dashboard', [App\Http\Controllers\Console\DashboardController::class, 'index']);

	Route::get('users/list', [App\Http\Controllers\Console\UserController::class, 'getUsers'])->name('users.list');
	Route::post('users/ajax_active_user', [App\Http\Controllers\Console\UserController::class, 'ajax_active_user']);

	Route::get('articles/list', [App\Http\Controllers\Console\ArticleController::class, 'getArticles'])->name('articles.list');
	Route::post('articles/ajax_approve_article', [App\Http\Controllers\Console\ArticleController::class, 'ajax_approve_article']);

	Route::get('article-categories', [App\Http\Controllers\Console\ArticleCategoryController::class, 'index']);
	Route::post('article-categories/ajax_cek_category', [App\Http\Controllers\Console\ArticleCategoryController::class, 'ajax_cek_category']);
	Route::post('article-categories/ajax_active_category', [App\Http\Controllers\Console\ArticleCategoryController::class, 'ajax_active_category']);
	Route::get('article-categories/{id}', [App\Http\Controllers\Console\ArticleCategoryController::class, 'show']);
	Route::post('article-categories', [App\Http\Controllers\Console\ArticleCategoryController::class, 'store']);
	Route::put('article-categories/{id}', [App\Http\Controllers\Console\ArticleCategoryController::class, 'update']);
	Route::delete('article-categories/destroy/{id}', [App\Http\Controllers\Console\ArticleCategoryController::class, 'destroy']);

	Route::get('facilities/list', [App\Http\Controllers\Console\FacilityController::class, 'getFacilities'])->name('facilities.list');
	Route::post('facilities/ajax_active_facility', [App\Http\Controllers\Console\FacilityController::class, 'ajax_active_facility']);

	Route::get('rooms/list', [App\Http\Controllers\Console\RoomController::class, 'getRooms'])->name('rooms.list');
	Route::post('rooms/ajax_approve_room', [App\Http\Controllers\Console\RoomController::class, 'ajax_approve_room']);
	
	Route::post('company-policies/ajax_approve_policy', [App\Http\Controllers\Console\CompanyPolicyController::class, 'ajax_approve_policy']);
	Route::post('teams/ajax_approve_team', [App\Http\Controllers\Console\TeamController::class, 'ajax_approve_team']);
	
	Route::get('rooms/booking_schedules', [App\Http\Controllers\Console\RoomController::class, 'booking_schedules']);
	Route::get('rooms/ajax_load_schedules/{scheduleId?}', [App\Http\Controllers\Console\RoomController::class, 'ajax_load_schedules']);
	Route::post('rooms/ajax_move_schedule', [App\Http\Controllers\Console\RoomController::class, 'ajax_move_schedule']);
	Route::get('rooms/ajax_get_today_schedules/{roomId}/{date}/{scheduleId?}', [App\Http\Controllers\Console\RoomController::class, 'ajax_get_today_schedules']);
	Route::post('rooms/ajax_create_booking_schedules', [App\Http\Controllers\Console\RoomController::class, 'ajax_create_booking_schedules']);
	Route::any('rooms/create_booking_schedules', [App\Http\Controllers\Console\RoomController::class, 'create_booking_schedules']);
	Route::post('rooms/ajax_edit_booking_schedules/{id}', [App\Http\Controllers\Console\RoomController::class, 'ajax_edit_booking_schedules']);
	Route::post('rooms/ajax_delete_booking_schedules', [App\Http\Controllers\Console\RoomController::class, 'ajax_delete_booking_schedules']);
	Route::any('rooms/edit_booking_schedules/{id}', [App\Http\Controllers\Console\RoomController::class, 'edit_booking_schedules']);
	Route::get('rooms/booking_schedule_list', [App\Http\Controllers\Console\RoomController::class, 'booking_schedule_list'])->name('rooms.booking_schedule_list');

	Route::get('medical', [App\Http\Controllers\Console\MedicalController::class, 'index']);

	Route::resources([
		'users' => App\Http\Controllers\Console\UserController::class,
		'articles' => App\Http\Controllers\Console\ArticleController::class,
		'facilities' => App\Http\Controllers\Console\FacilityController::class,
		'rooms' => App\Http\Controllers\Console\RoomController::class,
		'company-policies' => App\Http\Controllers\Console\CompanyPolicyController::class,
		'teams' => App\Http\Controllers\Console\TeamController::class,
	]);
});