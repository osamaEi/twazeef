<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Chat;
use App\Models\Message;
use Carbon\Carbon;

class ChatSeeder extends Seeder
{
    public function run()
    {
        // Get some users to create chats between
        $users = User::take(4)->get();

        if ($users->count() < 2) {
            $this->command->info('Not enough users to create chats. Please create users first.');
            return;
        }

        // Create a private chat between first two users
        $chat1 = Chat::create([
            'name' => 'Private Chat',
            'type' => 'private',
            'participants' => [$users[0]->id, $users[1]->id],
            'last_activity' => now()
        ]);

        // Add participants to the chat
        $chat1->participants()->attach([
            $users[0]->id => ['joined_at' => now(), 'status' => 'active'],
            $users[1]->id => ['joined_at' => now(), 'status' => 'active']
        ]);

        // Create some sample messages
        $messages = [
            [
                'chat_id' => $chat1->id,
                'user_id' => $users[0]->id,
                'content' => 'مرحباً! كيف حالك؟',
                'type' => 'text',
                'created_at' => now()->subHours(2)
            ],
            [
                'chat_id' => $chat1->id,
                'user_id' => $users[1]->id,
                'content' => 'أهلاً وسهلاً! بخير والحمد لله، وأنت؟',
                'type' => 'text',
                'created_at' => now()->subHours(1)
            ],
            [
                'chat_id' => $chat1->id,
                'user_id' => $users[0]->id,
                'content' => 'أنا أيضاً بخير، شكراً لك. هل تريد مناقشة أي موضوع معين؟',
                'type' => 'text',
                'created_at' => now()->subMinutes(30)
            ]
        ];

        foreach ($messages as $messageData) {
            Message::create($messageData);
        }

        // Update chat last activity
        $chat1->update(['last_activity' => now()->subMinutes(30)]);

        // Create another private chat if we have more users
        if ($users->count() >= 3) {
            $chat2 = Chat::create([
                'name' => 'Private Chat',
                'type' => 'private',
                'participants' => [$users[0]->id, $users[2]->id],
                'last_activity' => now()->subHours(1)
            ]);

            $chat2->participants()->attach([
                $users[0]->id => ['joined_at' => now()->subHours(1), 'status' => 'active'],
                $users[2]->id => ['joined_at' => now()->subHours(1), 'status' => 'active']
            ]);

            // Add a message to the second chat
            Message::create([
                'chat_id' => $chat2->id,
                'user_id' => $users[2]->id,
                'content' => 'مرحباً! أريد أن أتحدث معك حول موضوع مهم.',
                'type' => 'text',
                'created_at' => now()->subHours(1)
            ]);
        }

        $this->command->info('Chat seeder completed successfully!');
    }
}
