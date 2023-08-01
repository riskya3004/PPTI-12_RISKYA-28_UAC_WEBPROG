<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CoinTopUpController extends Controller
{
    public function topUp(Request $request)
    {
        $user = $request->user();
        $user->coins += 100;
        $user->save();

        return redirect()->back()->with('success', 'Koin berhasil ditambahkan.');
    }
}
