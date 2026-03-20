<?php

namespace App\Services\bot;

use App\Services\BotService;
use App\Services\bot\Commands\StartCommand;
use App\Services\bot\Commands\HelpCommand;

class BotHandler
{
    public function process(string $text, int $conversationId): array
    {
        // Команда /start
        if (in_array($text, ['/start', '/начать', '/начинать'])) {
            return (new StartCommand())->execute();
        }

        // Команды помощи (все варианты)
        if (in_array($text, ['/help', '/faq', '/FAQ', '/помощь', '/Часто задаваемые вопросы'])) {
            return (new HelpCommand())->execute();
        }

        // Обычный текст
        $botService = new BotService();

        return [
            'text' => $botService->replyTo($text),
            'buttons' => []
        ];
    }
}
