<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::forUser(Auth::id())
            ->with(['participants', 'latestMessage.user'])
            ->orderBy('last_activity', 'desc')
            ->get()
            ->map(function ($chat) {
                return [
                    'id' => $chat->id,
                    'name' => $chat->type === 'private'
                        ? $chat->otherParticipant?->name ?? 'Unknown'
                        : $chat->name,
                    'initials' => $chat->type === 'private'
                        ? $chat->otherParticipant?->initials ?? '??'
                        : mb_substr($chat->name, 0, 2),
                    'last_message' => $chat->latestMessage?->content ?? '',
                    'last_message_time' => $chat->latestMessage?->formatted_time ?? '',
                    'unread_count' => $chat->unread_count,
                    'online_status' => $chat->type === 'private'
                        ? $chat->otherParticipant?->online_status ?? 'offline'
                        : 'online',
                    'type' => $chat->type
                ];
            });

        return view('chat.index', compact('chats'));
    }

    public function startChat($applicantId, $applicationId = null)
    {
        $currentUserId = Auth::id();

        // Validate applicant exists
        $applicant = User::findOrFail($applicantId);

        // Try to find existing private chat between company and applicant
        $chat = Chat::where('type', 'private')
            ->whereJsonContains('participants', $currentUserId)
            ->whereJsonContains('participants', $applicantId)
            ->first();

        if (!$chat) {
            // Create new private chat
            $chat = Chat::create([
                'name' => 'Private Chat',
                'type' => 'private',
                'participants' => [$currentUserId, $applicantId],
                'last_activity' => now()
            ]);

            // Add participants
            $chat->participants()->attach([
                $currentUserId => ['joined_at' => now(), 'status' => 'active'],
                $applicantId => ['joined_at' => now(), 'status' => 'active']
            ]);
        }

        // Redirect to chat page
        return redirect()->route('chat.index')->with('selected_chat', $chat->id);
    }

    public function show(Chat $chat)
    {
        // Check if user is participant
        if (!$chat->participants()->where('user_id', Auth::id())->exists()) {
            abort(403);
        }

        // Mark messages as read
        $this->markMessagesAsRead($chat);

        $messages = $chat->messages()
            ->with('user')
            ->get()
            ->map(function ($message) {
                return [
                    'id' => $message->id,
                    'content' => $message->content,
                    'type' => $message->type,
                    'metadata' => $message->metadata,
                    'is_own' => $message->is_own,
                    'user_name' => $message->user->name,
                    'user_initials' => $message->user->initials,
                    'formatted_time' => $message->formatted_time,
                    'created_at' => $message->created_at->toISOString()
                ];
            });

        $chatInfo = [
            'id' => $chat->id,
            'name' => $chat->type === 'private'
                ? $chat->otherParticipant?->name ?? 'Unknown'
                : $chat->name,
            'initials' => $chat->type === 'private'
                ? $chat->otherParticipant?->initials ?? '??'
                : mb_substr($chat->name, 0, 2),
            'online_status' => $chat->type === 'private'
                ? $chat->otherParticipant?->online_status ?? 'offline'
                : 'online',
            'type' => $chat->type
        ];

        return response()->json([
            'chat' => $chatInfo,
            'messages' => $messages
        ]);
    }

    public function sendMessage(Request $request, Chat $chat)
    {
        // Check if user is participant
        if (!$chat->participants()->where('user_id', Auth::id())->exists()) {
            abort(403);
        }

        $messageType = $request->type ?? 'text';
        $content = $request->content;
        $metadata = null;

        // Handle file uploads
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $messageType = $this->getFileType($file);
            $content = $this->getFileContent($file, $messageType);
            $metadata = $this->getFileMetadata($file);
        }

        // Handle voice recording
        if ($request->hasFile('voice')) {
            $file = $request->file('voice');
            $messageType = 'voice';
            $content = $this->getFileContent($file, 'voice');
            $metadata = $this->getFileMetadata($file);
        }

        $request->validate([
            'content' => 'required|string|max:1000',
            'type' => 'in:text,file,image,voice'
        ]);

        $message = Message::create([
            'chat_id' => $chat->id,
            'user_id' => Auth::id(),
            'content' => $content,
            'type' => $messageType,
            'metadata' => $metadata
        ]);

        // Update chat last activity
        $chat->update(['last_activity' => now()]);

        // Load user relationship
        $message->load('user');

        return response()->json([
            'message' => [
                'id' => $message->id,
                'content' => $message->content,
                'type' => $message->type,
                'metadata' => $message->metadata,
                'is_own' => true,
                'user_name' => $message->user->name,
                'user_initials' => $message->user->initials,
                'formatted_time' => $message->formatted_time,
                'created_at' => $message->created_at->toISOString()
            ]
        ]);
    }

    public function createOrFindPrivateChat(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|different:' . Auth::id()
        ]);

        $otherUserId = $request->user_id;
        $currentUserId = Auth::id();

        // Try to find existing private chat between these users
        $chat = Chat::where('type', 'private')
            ->whereJsonContains('participants', $currentUserId)
            ->whereJsonContains('participants', $otherUserId)
            ->first();

        if (!$chat) {
            // Create new private chat
            $chat = Chat::create([
                'name' => 'Private Chat',
                'type' => 'private',
                'participants' => [$currentUserId, $otherUserId],
                'last_activity' => now()
            ]);

            // Add participants
            $chat->participants()->attach([
                $currentUserId => ['joined_at' => now(), 'status' => 'active'],
                $otherUserId => ['joined_at' => now(), 'status' => 'active']
            ]);
        }

        return response()->json(['chat_id' => $chat->id]);
    }

    public function markAsRead(Chat $chat)
    {
        // Check if user is participant
        if (!$chat->participants()->where('user_id', Auth::id())->exists()) {
            abort(403);
        }

        $this->markMessagesAsRead($chat);

        return response()->json(['success' => true]);
    }

    public function searchChats(Request $request)
    {
        $query = $request->get('q', '');

        if (empty($query)) {
            return response()->json([]);
        }

        $chats = Chat::forUser(Auth::id())
            ->where(function ($q) use ($query) {
                $q->where('chats.name', 'LIKE', "%{$query}%")
                    ->orWhereHas('participants', function ($subQ) use ($query) {
                        $subQ->where('users.name', 'LIKE', "%{$query}%")
                            ->where('users.id', '!=', Auth::id());
                    });
            })
            ->with(['participants', 'latestMessage'])
            ->limit(10)
            ->get()
            ->map(function ($chat) {
                return [
                    'id' => $chat->id,
                    'name' => $chat->type === 'private'
                        ? $chat->otherParticipant?->name ?? 'Unknown'
                        : $chat->name,
                    'initials' => $chat->type === 'private'
                        ? $chat->otherParticipant?->initials ?? '??'
                        : mb_substr($chat->name, 0, 2),
                    'last_message' => $chat->latestMessage?->content ?? '',
                    'unread_count' => $chat->unread_count,
                    'online_status' => $chat->type === 'private'
                        ? $chat->otherParticipant?->online_status ?? 'offline'
                        : 'online',
                ];
            });

        return response()->json($chats);
    }

    public function getUsers(Request $request)
    {
        $query = $request->get('q', '');

        $users = User::where('id', '!=', Auth::id())
            ->where('name', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get(['id', 'name', 'email'])
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'initials' => $user->initials
                ];
            });

        return response()->json($users);
    }

    public function getNewMessages(Request $request, Chat $chat)
    {
        // Check if user is participant
        if (!$chat->participants()->where('user_id', Auth::id())->exists()) {
            abort(403);
        }

        $lastMessageId = $request->get('last_message_id', 0);

        $messages = $chat->messages()
            ->where('id', '>', $lastMessageId)
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($message) {
                return [
                    'id' => $message->id,
                    'content' => $message->content,
                    'type' => $message->type,
                    'metadata' => $message->metadata,
                    'is_own' => $message->user_id === Auth::id(),
                    'user_name' => $message->user->name,
                    'user_initials' => $message->user->initials,
                    'formatted_time' => $message->formatted_time,
                    'created_at' => $message->created_at->toISOString()
                ];
            });

        return response()->json([
            'messages' => $messages,
            'last_message_id' => $chat->messages()->max('id') ?? 0
        ]);
    }

    private function markMessagesAsRead(Chat $chat)
    {
        // Update participant's last_read_at
        $chat->participants()
            ->where('user_id', Auth::id())
            ->update(['last_read_at' => now()]);

        // Mark unread messages as read
        $chat->messages()
            ->where('user_id', '!=', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }

    private function getFileType($file)
    {
        $mimeType = $file->getMimeType();

        if (str_starts_with($mimeType, 'image/')) {
            return 'image';
        } elseif (str_starts_with($mimeType, 'audio/')) {
            return 'voice';
        } else {
            return 'file';
        }
    }

    private function getFileContent($file, $type)
    {
        switch ($type) {
            case 'image':
                return 'صورة';
            case 'voice':
                return 'رسالة صوتية';
            default:
                return $file->getClientOriginalName();
        }
    }

    private function getFileMetadata($file)
    {
        $path = $file->store('chat-files', 'public');

        return [
            'name' => $file->getClientOriginalName(),
            'size' => $this->formatFileSize($file->getSize()),
            'url' => asset('storage/' . $path),
            'path' => $path,
            'mime_type' => $file->getMimeType()
        ];
    }

    private function formatFileSize($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }
}
