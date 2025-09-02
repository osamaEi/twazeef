<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'participants',
        'last_activity'
    ];

    protected $casts = [
        'participants' => 'array',
        'last_activity' => 'datetime'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class)->orderBy('created_at', 'asc');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'chat_participants')
            ->withPivot('joined_at', 'last_read_at', 'status')
            ->withTimestamps();
    }

    public function latestMessage()
    {
        return $this->hasOne(Message::class)->latestOfMany();
    }

    public function getUnreadCountAttribute()
    {
        if (!auth()->check()) return 0;

        $participant = $this->participants()->where('user_id', auth()->id())->first();
        if (!$participant) return 0;

        return $this->messages()
            ->where('user_id', '!=', auth()->id())
            ->where('created_at', '>', $participant->pivot->last_read_at ?? Carbon::parse('1970-01-01'))
            ->count();
    }

    public function getOtherParticipantAttribute()
    {
        if ($this->type !== 'private') return null;

        return $this->participants()
            ->where('user_id', '!=', auth()->id())
            ->first();
    }

    public function scopeForUser($query, $userId)
    {
        return $query->whereHas('participants', function ($q) use ($userId) {
            $q->where('user_id', $userId)->where('chat_participants.status', 'active');
        });
    }
}
