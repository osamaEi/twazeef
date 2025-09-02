<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name_ar',
        'last_name_ar',
        'first_name_en',
        'last_name_en',
        'email',
        'password',
        'role',
        'is_active',
        'phone',
        'bio',
        'company_name',
        'website',
        'logo',
        'description',
        'employee_count',
        'status',
        'address',
        'skills',
        'national_id',
        'birth_date',
        'gender',
        'marital_status',
        'education',
        'specialization',
        'national_id_image',
        'certificate_image',
        'experience_certificate',
        'cv',
        'commercial_license',
        'tax_certificate',

        // New company fields
        'entity_type',
        'license_number',
        'establishment_date',
        'business_sector',
        'entity_phone',
        'entity_email',
        'entity_description',
        'responsible_name',
        'responsible_position',
        'responsible_id',
        'responsible_phone',
        'responsible_email',
        'responsible_department',
        'authorization_scope',
        'additional_documents',
        'id_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'skills' => 'array',
    ];

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is company
     */
    public function isCompany(): bool
    {
        return $this->role === 'company';
    }

    /**
     * Check if user is employee
     */
    public function isEmployee(): bool
    {
        return $this->role === 'employee';
    }

    /**
     * Get jobs posted by company
     */
    public function jobs()
    {
        return $this->hasMany(Job::class, 'company_id');
    }

    /**
     * Get applications submitted by employee
     */
    public function applications()
    {
        return $this->hasMany(Application::class, 'applicant_id');
    }

    /**
     * Check if company is approved (email verified)
     */
    public function getIsApprovedAttribute(): bool
    {
        return $this->email_verified_at !== null;
    }

    /**
     * Check if user is active
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Get user's chats
     */
    public function chats()
    {
        return $this->belongsToMany(Chat::class, 'chat_participants')
            ->withPivot('joined_at', 'last_read_at', 'status')
            ->withTimestamps();
    }

    /**
     * Get user's messages
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get user's initials
     */
    public function getInitialsAttribute()
    {
        $names = explode(' ', $this->name);
        $initials = '';
        foreach ($names as $name) {
            $initials .= mb_substr($name, 0, 1);
        }
        return mb_strtoupper($initials);
    }

    /**
     * Get user's online status
     */
    public function getOnlineStatusAttribute()
    {
        // You can implement online status logic here
        // For now, return random status for demo
        $statuses = ['online', 'away', 'offline'];
        return $statuses[array_rand($statuses)];
    }
}
