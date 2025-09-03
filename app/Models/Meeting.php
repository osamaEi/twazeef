<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'platform',
        'meeting_link',
        'meeting_id',
        'meeting_password',
        'scheduled_date',
        'start_time',
        'end_time',
        'timezone',
        'status',
        'location',
        'attendees',
        'settings',
        'created_by',
        'company_id',
        'application_id',
        'calendar_event_id',
        'recording_info',
        'notes',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'attendees' => 'array',
        'settings' => 'array',
        'recording_info' => 'array',
    ];

    // Relationships
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function calendarEvent(): BelongsTo
    {
        return $this->belongsTo(Calendar::class, 'calendar_event_id');
    }

    // Scopes
    public function scopeForCompany($query, $companyId)
    {
        return $query->where('company_id', $companyId);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('scheduled_date', '>=', now()->toDateString())
            ->where('status', 'scheduled')
            ->orderBy('scheduled_date')
            ->orderBy('start_time');
    }

    public function scopeByPlatform($query, $platform)
    {
        return $query->where('platform', $platform);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByDate($query, $date)
    {
        return $query->where('scheduled_date', $date);
    }

    // Accessors
    public function getFormattedDateTimeAttribute()
    {
        return $this->scheduled_date->format('Y-m-d') . ' ' . $this->start_time->format('H:i');
    }

    public function getDurationAttribute()
    {
        $start = \Carbon\Carbon::parse($this->start_time);
        $end = \Carbon\Carbon::parse($this->end_time);
        return $start->diffInMinutes($end);
    }

    public function getAttendeesListAttribute()
    {
        if (!$this->attendees) {
            return collect();
        }

        return User::whereIn('id', array_column($this->attendees, 'user_id'))->get();
    }

    public function getPlatformNameAttribute()
    {
        $platforms = [
            'zoom' => 'Zoom Meeting',
            'teams' => 'Microsoft Teams',
            'meet' => 'Google Meet',
            'in_person' => 'اجتماع شخصي'
        ];

        return $platforms[$this->platform] ?? $this->platform;
    }

    public function getStatusTextAttribute()
    {
        $statuses = [
            'scheduled' => 'مجدول',
            'in_progress' => 'جاري',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغي',
            'postponed' => 'مؤجل'
        ];

        return $statuses[$this->status] ?? $this->status;
    }
}
