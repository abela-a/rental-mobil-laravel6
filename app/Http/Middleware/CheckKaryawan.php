<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckKaryawan
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role_id === 2) {
            return $next($request);
        }
        if (Auth::user()->role_id === 3) {
            return redirect()->route('pelanggan.dashboard');
        }
        if (Auth::user()->role_id === 1) {
            return redirect()->route('admin.dashboard');
        }
    }
}
