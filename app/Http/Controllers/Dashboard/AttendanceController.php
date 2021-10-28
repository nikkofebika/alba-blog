<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller {
    public function index() {
        return view('dashboard.attendance', ['active_menu'=>'attendance']);
    }

    public function leave_request() {
        return view('dashboard.leave_request.leave_request', ['active_menu'=>'leave-request']);
    }

    public function leave_balance() {
        return view('dashboard.leave_request.leave_balance', ['active_menu'=>'leave-balance']);
    }

    public function leave_approval() {
        return view('dashboard.leave_request.leave_approval', ['active_menu'=>'leave-approval']);
    }
}
