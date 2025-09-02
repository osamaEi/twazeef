<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Chat;
use App\Models\Message;
use Carbon\Carbon;

class ChatAdditionalSeeder extends Seeder
{
    public function run()
    {
        // Get multiple users for creating various chats
        $users = User::take(5)->get();

        if ($users->count() < 3) {
            $this->command->error('Need at least 3 users to create multiple chats. Found: ' . $users->count());
            return;
        }

        $this->command->info("Creating additional chats with " . $users->count() . " users");

        // Create chat between user 1 and user 2 (if different from existing)
        if ($users->count() >= 2) {
            $this->createChatBetweenUsers($users[0], $users[1], [
                'مرحباً! كيف يمكنني مساعدتك؟',
                'أريد أن أستفسر عن الوظائف المتاحة.',
                'بالطبع! لدينا عدة وظائف مفتوحة. أي مجال تفضل؟',
                'أنا مهتم بمجال البرمجة والتطوير.',
                'ممتاز! لدينا وظائف مطور ويب ومطور تطبيقات.'
            ]);
        }

        // Create chat between user 2 and user 3 (if available)
        if ($users->count() >= 3) {
            $this->createChatBetweenUsers($users[1], $users[2], [
                'مرحباً! هل يمكننا مناقشة مشروع جديد؟',
                'بالطبع! أخبرني التفاصيل.',
                'نريد تطوير نظام إدارة للموظفين.',
                'هذا مشروع مثير للاهتمام. ما هي المتطلبات؟',
                'نحتاج نظام شامل لإدارة الحضور والغياب والرواتب.'
            ]);
        }

        // Create chat between user 3 and user 4 (if available)
        if ($users->count() >= 4) {
            $this->createChatBetweenUsers($users[2], $users[3], [
                'أهلاً! كيف حال العمل؟',
                'بخير، شكراً لك. وأنت؟',
                'أنا أيضاً بخير. هل تريد مناقشة شيء معين؟',
                'نعم، أريد أن أتحدث عن تحسينات النظام.',
                'ممتاز! ما هي التحسينات التي تقترحها؟'
            ]);
        }

        // Create chat between user 4 and user 5 (if available)
        if ($users->count() >= 5) {
            $this->createChatBetweenUsers($users[3], $users[4], [
                'مرحباً! هل سمعت عن المشروع الجديد؟',
                'لا، أخبرني المزيد.',
                'إنه مشروع تطوير تطبيق جوال.',
                'رائع! ما هي التقنيات المستخدمة؟',
                'سنستخدم React Native و Laravel للخادم.'
            ]);
        }

        $this->command->info('Additional chat seeder completed successfully!');
    }

    private function createChatBetweenUsers($user1, $user2, $messages)
    {
        // Check if chat already exists
        $existingChat = Chat::where('type', 'private')
            ->whereJsonContains('participants', $user1->id)
            ->whereJsonContains('participants', $user2->id)
            ->first();

        if ($existingChat) {
            $this->command->info("Chat already exists between User {$user1->id} and User {$user2->id}");
            return $existingChat;
        }

        // Create new chat
        $chat = Chat::create([
            'name' => 'Private Chat',
            'type' => 'private',
            'participants' => [$user1->id, $user2->id],
            'last_activity' => now()
        ]);

        // Add participants
        $chat->participants()->attach([
            $user1->id => ['joined_at' => now(), 'status' => 'active'],
            $user2->id => ['joined_at' => now(), 'status' => 'active']
        ]);

        // Create messages
        $messageData = [];
        $currentTime = now()->subHours(2);

        foreach ($messages as $index => $content) {
            $userId = ($index % 2 == 0) ? $user1->id : $user2->id;
            $messageData[] = [
                'chat_id' => $chat->id,
                'user_id' => $userId,
                'content' => $content,
                'type' => 'text',
                'created_at' => $currentTime->addMinutes(15)
            ];
        }

        foreach ($messageData as $data) {
            Message::create($data);
        }

        // Update last activity
        $chat->update(['last_activity' => $currentTime]);

        $this->command->info("Created chat between User {$user1->id} ({$user1->name}) and User {$user2->id} ({$user2->name}) with " . count($messages) . " messages");

        return $chat;
    }
}
