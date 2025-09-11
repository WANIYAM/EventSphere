<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Helpers for readability
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isOrganizer()
    {
        return $this->role === 'organizer';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

    //  Relationships
    public function details()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'organizer_id');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'student_id');
    }

    public function registeredEvents()
    {
        return $this->belongsToMany(Event::class, 'registrations', 'student_id', 'event_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function media()
    {
        return $this->hasMany(MediaGallery::class, 'uploaded_by');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'student_id');
    }

    public function waitlists()
    {
        return $this->hasMany(EventWaitlist::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'created_by');
    }

    public function calendarSync()
    {
        return $this->hasMany(CalendarSync::class);
    }

    public function sharedEvents()
    {
        return $this->hasMany(EventShareLog::class);
    }

    public function approvedEvents()
    {
        return $this->hasMany(Event::class, 'approved_by');
    }
}
