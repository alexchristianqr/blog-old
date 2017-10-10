<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        if(!$request->user()->state == 'A'){
//        //logout, redirect wherever you want, etc.
//            return redirect()->to('login');
//        }

        if (auth()->check()) {
            if (auth()->user()->state != 'A') {
                auth()->logout();
                return redirect()->to('login')->withErrors('warning', 'Your session has expired because your account is deactivated.');
            }
        }
        return $next($request);
    }
}
