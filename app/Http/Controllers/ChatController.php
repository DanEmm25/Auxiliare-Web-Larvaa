<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Show all conversations for the logged-in user
    public function index()
    {
        $conversations = Conversation::where('user_one', Auth::id())
            ->orWhere('user_two', Auth::id())
            ->with('messages', 'userOne', 'userTwo')
            ->get();

        return view('chat.index', compact('conversations'));
    }

    // Show a specific chat
    public function show($receiverId)
    {
        $authUserId = Auth::id();

        // Get or create a conversation
        $conversation = Conversation::where(function ($query) use ($authUserId, $receiverId) {
            $query->where('user_one', $authUserId)->where('user_two', $receiverId);
        })->orWhere(function ($query) use ($authUserId, $receiverId) {
            $query->where('user_one', $receiverId)->where('user_two', $authUserId);
        })->first();

        // Fetch messages if conversation exists
        $messages = $conversation ? $conversation->messages()->latest()->get() : [];

        // Fetch the receiver's information
        $receiver = User::findOrFail($receiverId);

        return view('chat.show', compact('conversation', 'messages', 'receiver'));
    }

    // Send a message
    public function store(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'conversation_id' => $request->conversation_id,
            'sender_id' => Auth::id(),
            'content' => $request->message,
        ]);

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    // Start a new conversation or navigate to an existing one
    public function start($userId)
    {
        $authUserId = Auth::id();

        // Check if a conversation already exists
        $conversation = Conversation::where(function ($query) use ($authUserId, $userId) {
            $query->where('user_one', $authUserId)->where('user_two', $userId);
        })->orWhere(function ($query) use ($authUserId, $userId) {
            $query->where('user_one', $userId)->where('user_two', $authUserId);
        })->first();

        // Create a conversation if none exists
        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one' => $authUserId,
                'user_two' => $userId,
            ]);
        }

        // Redirect to the chat view for this conversation
        return redirect()->route('chat.show', ['receiverId' => $userId]);
    }
}
