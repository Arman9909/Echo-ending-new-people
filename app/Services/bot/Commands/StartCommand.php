<?php

namespace App\Services\bot\Commands;

class StartCommand
{
    public function execute(): array
    {
        return [
            'text' => "Здравствуйте, я — помощник echo-ending!
Со мной вы сможете освоить множество новых функций гораздо быстрее.
Чем я могу помочь?",

            'buttons' => [
                ['text' => '/help', 'label' => '📘 Help'],
                ['text' => '/faq', 'label' => '❓ FAQ'],
                ['text' => '/start', 'label' => '🔄 Restart'],
            ]
        ];
    }
}
