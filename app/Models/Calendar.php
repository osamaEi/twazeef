<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Calendar extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'start_time',
        'end_time',
        'type',
        'status',
        'location',
        'attendees',
        'created_by',
        'company_id',
        'application_id',
        'reminder_settings',
        'is_recurring',
        'recurrence_pattern',
    ];

    protected $casts = [
        'event_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'attendees' => 'array',
        'reminder_settings' => 'array',
        'recurrence_pattern' => 'array',
        'is_recurring' => 'boolean',
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

    public function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class, 'calendar_event_id');
    }

    // Scopes
    public function scopeForCompany($query, $companyId)
    {
        return $query->where('company_id', $companyId);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now()->toDateString())
            ->where('status', 'scheduled')
            ->orderBy('event_date')
            ->orderBy('start_time');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByDate($query, $date)
    {
        return $query->where('event_date', $date);
    }

    // Accessors
    public function getFormattedDateTimeAttribute()
    {
        return $this->event_date->format('Y-m-d') . ' ' . $this->start_time->format('H:i');
    }

    public function getDurationAttribute()
    {
        if ($this->end_time) {
            $start = \Carbon\Carbon::parse($this->start_time);
            $end = \Carbon\Carbon::parse($this->end_time);
            return $start->diffInMinutes($end);
        }
        return null;
    }

    public function getAttendeesListAttribute()
    {
        if (!$this->attendees) {
            return collect();
        }

        return User::whereIn('id', $this->attendees)->get();
    }
}
