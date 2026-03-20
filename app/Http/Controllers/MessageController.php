<?php
namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index($conversationId)
    {
        return Message::where('conversation_id', $conversationId)
            ->with('user')
            ->orderBy('created_at')
            ->get();
    }

    public function store(Request $request)
    {
        $msg = Message::create([
            'conversation_id' => $request->conversation_id,
            'user_id' => auth()->id() ?? 1,
            'text' => $request->text
        ]);

        return $msg->load('user');
    }
}
