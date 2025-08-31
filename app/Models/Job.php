<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    // Status constants
    const STATUS_ACTIVE = 'active';
    const STATUS_PAUSED = 'paused';
    const STATUS_CLOSED = 'closed';
    const STATUS_DRAFT = 'draft';

    // Type constants
    const TYPE_FULL_TIME = 'full-time';
    const TYPE_PART_TIME = 'part-time';
    const TYPE_CONTRACT = 'contract';
    const TYPE_FREELANCE = 'freelance';

    // Experience level constants
    const EXPERIENCE_ENTRY = 'entry';
    const EXPERIENCE_MID = 'mid';
    const EXPERIENCE_SENIOR = 'senior';
    const EXPERIENCE_EXECUTIVE = 'executive';

    protected $fillable = [
        'company_id',
        'title',
        'description',
        'location',
        'type',
        'experience_level',
        'salary_min',
        'salary_max',
        'salary_currency',
        'skills',
        'benefits',
        'status',
        'expires_at',
    ];

    protected $casts = [
        'skills' => 'array',
        'benefits' => 'array',
        'expires_at' => 'datetime',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
    ];

    /**
     * Get the company that posted the job
     */
    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    /**
     * Get applications for this job
     */
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Scope for active jobs
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for jobs that haven't expired
     */
    public function scopeNotExpired($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
        });
    }

    /**
     * Get all available statuses
     */
    public static function getAvailableStatuses()
    {
        return [
            self::STATUS_ACTIVE => 'نشطة',
            self::STATUS_PAUSED => 'معلقة',
            self::STATUS_CLOSED => 'مغلقة',
            self::STATUS_DRAFT => 'مسودة',
        ];
    }

    /**
     * Check if a user has already applied to this job
     */
    public function hasUserApplied($userId)
    {
        return $this->applications()->where('applicant_id', $userId)->exists();
    }

    /**
     * Get the application for a specific user
     */
    public function getUserApplication($userId)
    {
        return $this->applications()->where('applicant_id', $userId)->first();
    }

    /**
     * Get formatted salary range
     */
    public function getFormattedSalaryAttribute()
    {
        if ($this->salary_min && $this->salary_max) {
            return "{$this->salary_min} - {$this->salary_max} {$this->salary_currency}";
        } elseif ($this->salary_min) {
            return "من {$this->salary_min} {$this->salary_currency}";
        } elseif ($this->salary_max) {
            return "حتى {$this->salary_max} {$this->salary_currency}";
        }
        return 'غير محدد';
    }

    /**
     * Get formatted job type
     */
    public function getFormattedTypeAttribute()
    {
        $types = [
            'full-time' => 'دوام كامل',
            'part-time' => 'دوام جزئي',
            'contract' => 'عقد مؤقت',
            'freelance' => 'عمل حر',
        ];
        
        return $types[$this->type] ?? $this->type;
    }

    /**
     * Get formatted experience level
     */
    public function getFormattedExperienceAttribute()
    {
        $levels = [
            'entry' => 'مبتدئ',
            'mid' => 'متوسط',
            'senior' => 'خبير',
            'executive' => 'تنفيذي',
        ];
        
        return $levels[$this->experience_level] ?? $this->experience_level;
    }

    /**
     * Get all available types
     */
    public static function getAvailableTypes()
    {
        return [
            self::TYPE_FULL_TIME => 'دوام كامل',
            self::TYPE_PART_TIME => 'دوام جزئي',
            self::TYPE_CONTRACT => 'عقد مؤقت',
            self::TYPE_FREELANCE => 'عمل حر',
        ];
    }

    /**
     * Get all available experience levels
     */
    public static function getAvailableExperienceLevels()
    {
        return [
            self::EXPERIENCE_ENTRY => 'مبتدئ (0-2 سنة)',
            self::EXPERIENCE_MID => 'متوسط (3-5 سنة)',
            self::EXPERIENCE_SENIOR => 'متقدم (6-10 سنة)',
            self::EXPERIENCE_EXECUTIVE => 'خبير (أكثر من 10 سنوات)',
        ];
    }

    /**
     * Check if job is active
     */
    public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    /**
     * Check if job is draft
     */
    public function isDraft()
    {
        return $this->status === self::STATUS_DRAFT;
    }

    /**
     * Check if job is paused
     */
    public function isPaused()
    {
        return $this->status === self::STATUS_PAUSED;
    }

    /**
     * Check if job is closed
     */
    public function isClosed()
    {
        return $this->status === self::STATUS_CLOSED;
    }
}
