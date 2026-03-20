<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Conversation;

class ConversationSeeder extends Seeder
{
    public function run()
    {
        Conversation::create([
            'user1_id' => 1,
            'user2_id' => 2,
        ]);

        Conversation::create([
            'user1_id' => 1,
            'user2_id' => 3,
        ]);
    }
}
