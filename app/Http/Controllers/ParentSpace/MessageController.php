<?php

namespace App\Http\Controllers\ParentSpace;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $messages = Message::where('sender_id', $user->id)
            ->orWhere('recipient_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $admins = User::where('role', 'admin')->get();

        return view('parent.messages', compact('messages', 'admins'));
    }

    public function show($id)
    {
        $message = Message::with(['sender', 'recipient', 'replies'])->findOrFail($id);

        if ($message->recipient_id === Auth::id() && !$message->read_at) {
            $message->update(['read_at' => now()]);
        }

        return view('parent.message-show', compact('message'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $validated['sender_id'] = Auth::id();
        Message::create($validated);

        return back()->with('success', 'Message envoyé avec succès.');
    }
}
