<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotLoggedIn
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            if ($request->route()->getName() == 'user.profile') {
                // Jika pengguna belum login dan mengakses halaman profil pengguna, redirect ke halaman login
                return redirect()->route('login')->with('error', 'Anda perlu masuk untuk melihat profil pengguna.');
            } else {
                // Jika pengguna belum login dan mengakses halaman lain, redirect ke halaman login
                return redirect()->route('login')->with('error', 'Anda perlu masuk untuk mengakses halaman ini.');
            }
        }

        return $next($request);
    }
}


