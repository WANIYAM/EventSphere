<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Event extends Model
{
     use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'date',
        'time',
        'venue',
        'organizer_id',
        'status',
        'max_participants',
    ];
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function registrations()
{
    return $this->hasMany(Registration::class);
}


    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function media()
    {
        return $this->hasMany(MediaGallery::class);
    }

    public function seating()
    {
        return $this->hasOne(EventSeating::class);
    }

    public function waitlists()
    {
        return $this->hasMany(EventWaitlist::class);
    }

    public function calendarSync()
    {
        return $this->hasMany(CalendarSync::class);
    }

    public function shareLogs()
    {
        return $this->hasMany(EventShareLog::class);
    }
   public function isApproved()
    {
        return $this->status === 'approved';
    }
}
