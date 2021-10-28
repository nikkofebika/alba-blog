<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicalController extends Controller {
	public function index(){
		return view('console.medical.index', ['page_title' => 'Medical', 'active_menu' => 'medical']);
	}
}
