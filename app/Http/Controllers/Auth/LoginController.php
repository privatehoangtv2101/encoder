<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Domains\Admin\Entities\Admin;
use Illuminate\Http\Request;

class LoginController extends Controller {

    use AuthenticatesUsers;

    public function username() {
        return 'email';
    }

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function authenticate(Request $request,Admin $admin) {
        $password = $request->input('password');
        $email = $request->input('email');
        
        if ($admin->login($email, $password)) {
            return redirect()->intended('/');
        }
        
        return view('auth.login');
    }

}
