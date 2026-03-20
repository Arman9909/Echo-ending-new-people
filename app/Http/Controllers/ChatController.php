<?php
/*
namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Services\BotService;

class ChatController extends Controller
{
    public function send(Request $request, BotService $botService)
    {
        $conversationId = 1;


        $userId = auth()->id() ?? 1; // твой пользователь

        // 1. Сохраняем сообщение пользователя
        $userMessage = Message::create([
            'conversation_id' => $conversationId,
            'user_id' => $userId,
            'text' => $request->text,
        ]);

        // 2. Получаем ответ бота (логика бота внутри сервиса)
        $botReplyText = $botService->replyTo($request->text);

        // 3. Сохраняем сообщение бота
        $botMessage = Message::create([
            'conversation_id' => $conversationId,
            'user_id' => config('chat.bot_user_id', 0), // условный бот
            'text' => $botReplyText,
        ]);

        // 4. Возвращаем оба сообщения
        return response()->json([
            'user_message' => $userMessage,
            'bot_message'  => $botMessage,
        ]);
    }

    public function index($conversationId)
    {
        return Message::where('conversation_id', $conversationId)
            ->orderBy('created_at')
            ->get();
    }
}*/


namespace App\Http\Controllers;

use App\Models\Message;
use App\Services\BotService;
use Illuminate\Http\Request;
use App\Services\bot;

class ChatController extends Controller
{
    public function send(Request $request, BotService $botService)
    {
        $conversationId = 1;
        $userId = auth()->id() ?? 1;

        $text = trim($request->text);

        // 1. Сохраняем сообщение пользователя
        $userMessage = Message::create([
            'conversation_id' => $conversationId,
            'user_id' => $userId,
            'text' => $text,
        ]);

        // 2. Получаем ответ бота через фасад
        $botResponse = $botService->handle($text, $conversationId);

        // 3. Сохраняем сообщение бота
        $botMessage = Message::create([
            'conversation_id' => $conversationId,
            'user_id' => 0,
            'text' => $botResponse['text'],
        ]);


        // 4. Возвращаем JSON
        // 4. Возвращаем JSON
        return response()->json([
            'user_message' => $userMessage,
            'bot_message' => [
                'id' => $botMessage->id,
                'user_id' => 0, // ← ВОТ ЭТО ГЛАВНОЕ
                'text' => $botResponse['text'],
                'buttons' => $botResponse['buttons'] ?? [],
                'created_at' => $botMessage->created_at
            ]
        ]);

    }

    public function index($conversationId)
    {
        return Message::where('conversation_id', $conversationId)
            ->orderBy('created_at')
            ->get();
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:4096'
        ]);

        $path = $request->file('image')->store('chat_images', 'public');

        return [
            'user_id' => auth()->id(),
            'text' => null,
            'image' => asset('storage/' . $path),
            'created_at' => now()->toDateTimeString()
        ];
    }
}
