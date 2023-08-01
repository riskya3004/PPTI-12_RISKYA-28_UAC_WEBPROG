<?php

namespace App\Http\Controllers;

use App\Models\AvatarSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvatarSubmissionController extends Controller
{
    public function showForm()
    {
        return view('avatar_submission.form');
    }

    public function submitAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'receiver_id' => 'required|exists:users,id',
        ]);

        $avatar = $request->file('avatar');
        $avatarName = time() . '.' . $avatar->extension();
        $avatar->storeAs('public/avatar_submissions', $avatarName);

        AvatarSubmission::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->input('receiver_id'),
            'avatar_path' => 'avatar_submissions/' . $avatarName,
        ]);

        return redirect()->route('collectors.angels')->with('success', 'Avatar submitted successfully.');
    }
}

