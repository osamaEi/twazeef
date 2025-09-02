<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Chat;
use App\Models\Message;
use Carbon\Carbon;

class ChatTestSeeder extends Seeder
{
    public function run()
    {
        // Get user with ID 8
        $user8 = User::find(8);
        
        if (!$user8) {
            $this->command->error('User with ID 8 not found. Please create this user first.');
            return;
        }

        // Get another user (preferably different from user 8)
        $otherUser = User::where('id', '!=', 8)->first();
        
        if (!$otherUser) {
            $this->command->error('No other users found. Please create at least one more user.');
            return;
        }

        $this->command->info("Creating chat between User {$user8->id} ({$user8->name}) and User {$otherUser->id} ({$otherUser->name})");

        // Check if chat already exists between these users
        $existingChat = Chat::where('type', 'private')
            ->whereJsonContains('participants', $user8->id)
            ->whereJsonContains('participants', $otherUser->id)
            ->first();

        if ($existingChat) {
            $this->command->info("Chat already exists between these users (Chat ID: {$existingChat->id})");
            $chat = $existingChat;
        } else {
            // Create new private chat
            $chat = Chat::create([
                'name' => 'Private Chat',
                'type' => 'private',
                'participants' => [$user8->id, $otherUser->id],
                'last_activity' => now()
            ]);

            // Add participants to the chat
            $chat->participants()->attach([
                $user8->id => ['joined_at' => now(), 'status' => 'active'],
                $otherUser->id => ['joined_at' => now(), 'status' => 'active']
            ]);

            $this->command->info("Created new chat with ID: {$chat->id}");
        }

        // Create some sample messages
        $messages = [
            [
                'chat_id' => $chat->id,
                'user_id' => $user8->id,
                'content' => 'مرحباً! كيف حالك؟',
                'type' => 'text',
                'created_at' => now()->subHours(3)
            ],
            [
                'chat_id' => $chat->id,
                'user_id' => $otherUser->id,
                'content' => 'أهلاً وسهلاً! بخير والحمد لله، وأنت؟',
                'type' => 'text',
                'created_at' => now()->subHours(2)
            ],
            [
                'chat_id' => $chat->id,
                'user_id' => $user8->id,
                'content' => 'أنا أيضاً بخير، شكراً لك. هل تريد مناقشة أي موضوع معين؟',
                'type' => 'text',
                'created_at' => now()->subHours(1)
            ],
            [
                'chat_id' => $chat->id,
                'user_id' => $otherUser->id,
                'content' => 'نعم، أريد أن أتحدث معك حول مشروع جديد.',
                'type' => 'text',
                'created_at' => now()->subMinutes(45)
            ],
            [
                'chat_id' => $chat->id,
                'user_id' => $user8->id,
                'content' => 'ممتاز! أخبرني المزيد عن هذا المشروع.',
                'type' => 'text',
                'created_at' => now()->subMinutes(30)
            ],
            [
                'chat_id' => $chat->id,
                'user_id' => $otherUser->id,
                'content' => 'إنه مشروع تطوير موقع ويب جديد. هل أنت مهتم؟',
                'type' => 'text',
                'created_at' => now()->subMinutes(15)
            ]
        ];

        // Check if messages already exist to avoid duplicates
        $existingMessages = Message::where('chat_id', $chat->id)->count();
        
        if ($existingMessages == 0) {
            foreach ($messages as $messageData) {
                Message::create($messageData);
            }
            $this->command->info("Created " . count($messages) . " sample messages");
        } else {
            $this->command->info("Messages already exist for this chat ({$existingMessages} messages)");
        }

        // Update chat last activity
        $chat->update(['last_activity' => now()->subMinutes(15)]);

        $this->command->info('Chat test seeder completed successfully!');
        $this->command->info("Chat ID: {$chat->id}");
        $this->command->info("Participants: User {$user8->id} and User {$otherUser->id}");
        $this->command->info("Total messages: " . Message::where('chat_id', $chat->id)->count());
    }
}
