<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CasualFriend;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CasualFriendController extends Controller
{
    public function index()
    {
        $casualFriends = CasualFriend::all();
        return view('home', compact('casualFriends'));
    }

    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'username' => 'required|string|unique:casual_friends',
            'email' => 'required|email|unique:casual_friends',
            'hobbies' => 'required|string',
            'birthdate' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'mobile_number' => 'required|digits_between:8,15',
            'instagram_username' => 'required|url',
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|string|min:6',
            'registration_price' => 'required|integer'
        ]);

        // Simpan data pengguna ke dalam basis data menggunakan model CasualFriend
        CasualFriend::create([
            'full_name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'hobbies' => $request->hobbies,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'mobile_number' => $request->mobile_number,
            'instagram_username' => $request->instagram_username,
            'profile_photo' => $request->profile_photo,
            'password' => bcrypt($request->password),
            'registration_price' => $request->registration_price,
        ]);

        // Set session setelah registrasi berhasil
        Session::flash('success', 'Registrasi berhasil! Selamat datang di ConnectFriend!');

        // Redirect pengguna ke halaman sukses atau halaman lainnya
        return redirect()->route('home');
    }

    public function show($id)
    {
        $casualFriend = CasualFriend::findOrFail($id);
        return view('casual_friends.show', compact('casualFriend'));
    }

}
