<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\User;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function index()
    {
        $avatars = Avatar::all();
        return view('avatars.index', compact('avatars'));
    }

    public function purchase(Avatar $avatar)
    {
        $user = auth()->user();
        if ($user->coins >= $avatar->price) {
            $user->coins -= $avatar->price;
            $user->profile_photo_path = 'avatars/' . $avatar->name;
            // $user->save();

            return redirect()->route('home')->with('success', 'Avatar purchased successfully.');
        } else {
            return redirect()->route('home')->with('error', 'Not enough coins to purchase the avatar.');
        }
    }
}
