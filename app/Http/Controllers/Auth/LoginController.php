<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/console/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	$this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
    	return view('console.auth.login');
    }

    public function login(Request $request)
    {
    	$this->validateLogin($request);
    	if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
    		$this->fireLockoutEvent($request);

    		return $this->sendLockoutResponse($request);
    	}

    	if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_active' => 1], $request->filled('remember'))) {
    		return $this->sendLoginResponse($request);
    	}

    	$this->incrementLoginAttempts($request);

    	return back()->withInput()->with('error','Kombinasi Email dan Password tidak cocok!');
    }

    public function logout(Request $request) {
    	Auth::logout();

    	$request->session()->invalidate();

    	$request->session()->regenerateToken();

    	return redirect('/');
    }
}
