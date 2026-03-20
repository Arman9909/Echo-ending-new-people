<?php

namespace App\Services;

use App\Services\bot\BotHandler;

class BotService
{
    public function handle(string $text, int $conversationId): array
    {
        $handler = new BotHandler();
        return $handler->process($text, $conversationId);
        }
    public function replyTo(string $text): string
    {
        // Здесь может быть любая логика:
        // - вызов внешнего API
        // - правила
        // - ИИ и т.д.

        // Простейший пример:
        if (mb_stripos($text, 'привет') !== false) {
            return 'Привет! Рад тебя видеть в чате 🙂';
        }

        if (mb_stripos($text, 'как дела') !== false) {
            return 'У меня всё стабильно, я — код. А у тебя как?';
        }

        return 'Я пока не всё понимаю, но учусь. Спроси меня что-нибудь ещё.';
    }
}
