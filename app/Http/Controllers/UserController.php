<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'username' => 'required|string|unique:users,username,' . Auth::user()->id,
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'birthdate' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'mobile_number' => 'required|digits_between:8,15',
            'instagram_username' => 'required|url',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:6',
        ]);

        $user = Auth::user();

        $user->full_name = $request->full_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->birthdate = $request->birthdate;
        $user->gender = $request->gender;
        $user->mobile_number = $request->mobile_number;
        $user->instagram_username = $request->instagram_username;

        // Jika ada foto baru diunggah, simpan foto dan update path di database
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) {
                Storage::delete($user->profile_photo_path);
            }

            $path = $request->file('profile_photo')->store('public/profile-photos');
            $user->profile_photo_path = $path;
        }

        // Jika pengguna mengisi password baru, hash password sebelum menyimpannya
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        // $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function deleteProfilePhoto()
    {
        $user = Auth::user();

        if ($user->profile_photo_path) {
            Storage::delete($user->profile_photo_path);
            $user->profile_photo_path = null;
            // $user->save();
        }

        return back()->with('success', 'Foto profil berhasil dihapus.');
    }

    // Metode-metode lain untuk pengelolaan pengguna, seperti edit, delete, dll.
}
