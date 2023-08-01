<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function sendChat(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $senderId = Auth::id();
        $receiverId = $request->input('receiver_id');
        $message = $request->input('message');

        Chat::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'message' => $message,
        ]);

        return back()->with('success', 'Message sent.');
    }

    public function showChat()
    {
        $user = Auth::user();
        $chats = Chat::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('chat.show', compact('chats'));
    }
}
