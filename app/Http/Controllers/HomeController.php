<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::all();
        $genderFilter = null;
        $searchKeyword = null;

        return view('home', compact('users', 'genderFilter', 'searchKeyword'));
    }

    public function filterByGender(Request $request)
    {
        $genderFilter = $request->input('gender');

        // Jika filter "All" dipilih, maka tampilkan semua pengguna
        if ($genderFilter === 'All') {
            return redirect()->route('home');
        }

        $users = User::where('gender', $genderFilter)->get();

        return view('home', compact('users', 'genderFilter'));
    }

    public function filterByGenderAndSearch(Request $request)
    {
        $genderFilter = $request->input('gender');
        $searchKeyword = $request->input('search');

        // Jika filter "All" dipilih, maka tampilkan semua pengguna
        if ($genderFilter === 'All') {
            $users = User::all();
        } else {
            $users = User::where('gender', $genderFilter)->get();
        }

        return view('home', compact('users', 'genderFilter', 'searchKeyword'));
    }
}
