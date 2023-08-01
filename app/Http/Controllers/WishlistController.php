<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishlist(User $user)
    {
        // Pastikan pengguna telah login sebelum menambahkan ke Wishlist
        if (Auth::check()) {
            $loggedInUser = Auth::user();

            // Dapatkan Wishlist pengguna yang sudah ada (jika ada)
            $wishlist = $loggedInUser->wishlist ?? [];

            // Tambahkan pengguna ke dalam Wishlist jika belum ada
            if (!in_array($user->id, $wishlist)) {
                $wishlist[] = $user->id;

                // Simpan Wishlist baru ke dalam database
                $loggedInUser->wishlist = $wishlist; // Ubah metode update menjadi assignment langsung
                // $loggedInUser->save(); // Simpan perubahan ke database
            }

            // Redirect kembali ke halaman sebelumnya
            return back()->with('success', 'User has been added to your Wishlist.');
        }

        // Jika pengguna belum login, arahkan ke halaman login
        return redirect()->route('login')->with('error', 'Please login to add users to your Wishlist.');
    }
}
