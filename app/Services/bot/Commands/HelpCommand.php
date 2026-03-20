<?php

namespace App\Services\bot\Commands;

class HelpCommand
{
    public function execute(): array
    {
        return [
            'text' =>
                "📘 Часто задаваемые вопросы \n
        1️⃣ Как работает бот?\n
        2️⃣ Что делать/начать?\n
        3️⃣ Что делает/помогает?\n
        4️⃣ Какой вопрос задать?\n
        5️⃣ Почему бот отвечает?\n
        6️⃣ Можно ли добавить свои команды?\n
        7️⃣ Как сохранить диалог?\n
        8️⃣ Почему нет кнопок?\n
        9️⃣ Можно меню?\n
        🔟 Поддержка",



            'buttons' => [
                ['text' => '/start', 'label' => '🔙 Назад'],
                ['text' => '/faq', 'label' => '❓ FAQ'],
            ]
        ];
    }
}
