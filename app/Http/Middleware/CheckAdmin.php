<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CheckAdmin
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
        if (Auth::user()->role_id === 1) {
            View::share(['role' => 'admin', 'role_name' => 'Admin']);
            return $next($request);
        }
        if (Auth::user()->role_id === 2) {
            View::share(['role' => 'karyawan', 'role_name' => 'Karyawan']);
            return redirect()->route('karyawan.dashboard');
        }
        if (Auth::user()->role_id === 3) {
            View::share(['role' => 'pelanggan', 'role_name' => 'Pelanggan']);
            return redirect()->route('pelanggan.dashboard');
        }
    }
}
