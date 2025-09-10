<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
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
}
