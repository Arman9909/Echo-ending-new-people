<?php
/*
namespace App\Services\bot;

use App\Services\BotService;
use App\Services\bot\Commands\StartCommand;
use App\Services\bot\Commands\HelpCommand;

class BotHandler
{
    public function process(string $text, int $conversationId): array
    {

        // 0. Запуск истории Колобка
        if ($text === '/start_story') {
            $story = $this->story->getStory();
            return $this->formatNode($story['start_story']);
        }

        // Команда /start
        if (in_array($text, ['/start', '/начать', '/начинать'])) {
            return (new StartCommand())->execute();
        }

        // Команды помощи (все варианты)
        if (in_array($text, ['/help', '/faq', '/FAQ', '/помощь', '/Часто задаваемые вопросы']))  {
            return (new HelpCommand())->execute();
        }

        // Обычный текст
        $botService = new BotService();

        return [
            'text' => $botService->replyTo($text),
            'buttons' => []

        ];
    }
}*/


namespace App\Services\bot;

use App\Services\BotService;
use App\Services\StoryService;
use App\Services\bot\Commands\StartCommand;
use App\Services\bot\Commands\HelpCommand;

class BotHandler
{
    protected StoryService $story;

    public function __construct()
    {
        $this->story = new StoryService();
    }

    public function process(string $text, int $conversationId): array
    {
        // запуск истории
        if ($text === '/start_story') {
            $story = $this->story->getStory();
            return $this->formatNode($story['start_story']);
        }
        // 🔥 ВСТАВЛЯЕШЬ ВОТ ЭТО СЮДА 🔥
        // обработка всех шагов истории
        $story = $this->story->getStory();

        if (isset($story[$text])) {
            $node = $story[$text];

            // если это финал — добавляем кнопки меню
            if (count($node['choices']) === 1 && $node['choices'][0]['next'] === 'start_story') {
                return [
                    'text' => $node['text'],
                    'buttons' => [
                        ['text' => 'start_story', 'label' => '🔄 Попробовать снова'],
                        ['text' => '/start', 'label' => '🔙 Назад'],
                        ['text' => '/help', 'label' => '📘 Help'],
                        ['text' => '/faq', 'label' => '❓ FAQ'],
                    ]
                ];
            }

            // обычный узел истории
            return $this->formatNode($node);
        }

        // команда /start
        if (in_array($text, ['/start', '/начать', '/начинать'])) {
            return (new StartCommand())->execute();
        }

        // help/faq
        if (in_array($text, ['/help', '/faq', '/FAQ', '/помощь', '/Часто задаваемые вопросы'])) {
            return (new HelpCommand())->execute();
        }

        // обычный текст
        $botService = new BotService();

        return [
            'text' => $botService->replyTo($text),
            'buttons' => []
        ];
    }

    protected function formatNode(array $node): array
    {
        return [
            'text' => $node['text'],
            'buttons' => array_map(fn($choice) => [
                'text' => $choice['next'],      // что отправляем
                'label' => $choice['label'],     // что показываем
            ], $node['choices'] ?? [])

        ];
    }

}
