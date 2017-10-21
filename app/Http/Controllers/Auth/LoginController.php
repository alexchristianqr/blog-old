<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
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
//        $this->middleware('guest', ['except' => 'logout']);
    }

    public function fnDoLogin(Request $request)
    {
        session(['super_administrator' => false]);

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

                        $type_user = (new User)->join('type_user', 'type_user.id', '=', 'users.id_type_user')->where('users.id_type_user', auth()->user()->id_type_user)->first(['type_user.id', 'type_user.name', 'type_user.roles']);

                        if(count(json_decode($type_user->roles))){
                            $rols = $type_user->roles;
                        }else{
                            $rols='{}';
                        }
                        $session_roles = json_decode($rols);

                        // Create Sessions
                        session(['session_roles' => $session_roles]);
                        session(['session_type_user' => $type_user]);

                        // Session Super-Administrator
                        if ($type_user->id == 1)
                            session(['super_administrator' => true]);

                        // Redirect Login
                        return $this->authenticated($request, $this->guard()->user()) ?: redirect()->to('cms/home');
                        break;
                }
            }
        }
        return redirect()->back()->withInput()->withErrors(trans('auth.failed'));
    }

    public function fnDoLogout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect()->to('/login');
    }
}
