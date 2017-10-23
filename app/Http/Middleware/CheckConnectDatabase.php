<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Exception;

class CheckConnectDatabase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Test database connection
        try {
            DB::connection()->getPdo();
        } catch (Exception $e) {
            abort(503);
        }
        return $next($request);
    }
}
