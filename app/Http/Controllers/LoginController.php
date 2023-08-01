<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

// use App\Http\Controllers\Auth\AuthenticatesUsers;;

class LoginController extends Controller
{
    // use AuthenticatesUsers;

    // Fungsi untuk menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Metode lain dalam LoginController (seperti fungsi login, logout, dll.)
}
