<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    public function run()
    {
        Message::create([
            'conversation_id' => 1,
            'user_id' => 1,
            'text' => 'Привет!',
        ]);

        Message::create([
            'conversation_id' => 1,
            'user_id' => 2,
            'text' => 'Здорово!',
        ]);

        Message::create([
            'conversation_id' => 2,
            'user_id' => 1,
            'text' => 'Как дела?',
        ]);
    }
}

/*
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    public function run()
    {
        Message::create([
            'conversation_id' => 1,
            'user_id' => 1,
            'text' => 'Привет!',
        ]);

        Message::create([
            'conversation_id' => 1,
            'user_id' => 0,
            'text' => 'Здравствуйте, я бот.',
        ]);

        Message::create([
            'conversation_id' => 2,
            'user_id' => 1,
            'text' => 'Как дела?',
        ]);
    }
}*/
