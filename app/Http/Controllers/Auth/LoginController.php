<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

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
    protected $redirectTo = 'admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function fnDoLogin(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        $remember = (Input::has('remember')) ? true : false;

        if (Auth::attempt($credentials, $remember)) {
            switch (Auth::user()->state) {
                case 'I':
                    Auth::logout();
                    $msg = "El estado esta como INACTIVO, contácte al administrador.";
                    return redirect()->back()->withInput($request->toArray())->withErrors($msg);
                    break;
                default:
                    return redirect()->to('admin/home');
                    break;
            }
        } else {
            return redirect()->back()->withInput($request->toArray())->withErrors('Estas credenciales no coinciden con nuestros registros.');
        }
    }

}
