<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function hideFromHome()
    {
        $user = Auth::user();

        if ($user->coins >= 50) {
            // Kurangi koin pengguna
            $user->coins -= 50;
            // $user->save();

            // Sembunyikan foto pengguna dari daftar halaman utama
            $user->visible = false;
            // $user->save();


            return back()->with('success', 'Anda telah menghilang dari daftar di halaman utama.');
        } else {
            return back()->with('error', 'Koin Anda tidak mencukupi.');
        }
    }

    public function setRandomBearPhoto()
{
    $user = Auth::user();
    // $user->setRandomBearPhoto();
    $user->visible = true; // Pengaturan foto beruang akan membuat foto pengguna menjadi terlihat oleh pengguna lain
    // $user->save();

    return back()->with('success', 'Foto beruang Anda telah diatur secara acak.');
}
}