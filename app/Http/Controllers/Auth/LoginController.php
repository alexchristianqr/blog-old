<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/cms/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function fnDoLogin(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        $remember = $request->has('remember') ? true : false;
        if ($this->guard()->attempt($credentials, $remember)) {
            if (auth()->once($credentials)) {
                switch (auth()->user()->status) {
                    case 'I':
                        auth()->logout();
                        $msg = "Your session has expired because your account is Inactive.";
                        return redirect()->to('login')->withInput()->withErrors($msg);
                        break;
                    default:
                        $request->session()->regenerate();
                        $this->clearLoginAttempts($request);
                        return $this->authenticated($request, $this->guard()->user()) ?: redirect()->intended('cms/home');
                        break;
                }
            }
        }
        return redirect()->back()->withInput()->withErrors(trans('auth.failed'));
    }
}
