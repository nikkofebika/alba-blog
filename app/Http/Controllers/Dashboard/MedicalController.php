<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicalController extends Controller {
    public function index() {
        return view('dashboard.medical.index', ['active_menu'=>'medical']);
    }
}
