<?php

namespace App\Http\Controllers;

use App\Models\AvatarSubmission;

class CollectorsAngelsController extends Controller
{
    public function showSubmissions()
    {
        $avatarSubmissions = AvatarSubmission::with('sender', 'receiver')->get();
        return view('collectors_angels.show_submissions', compact('avatarSubmissions'));
    }
}
