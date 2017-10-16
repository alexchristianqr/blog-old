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
        if (auth()->check()) {
            if (auth()->user()->status != 'A') {
                auth()->logout();
                return redirect()->to('login')->withErrors('warning', 'Your session has expired because your account is deactivated.');
            }
        }
        return $next($request);
    }
}
