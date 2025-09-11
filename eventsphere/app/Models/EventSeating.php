<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSeating extends Model
{
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function remainingSeats()
    {
        return $this->total_seats - $this->seats_booked;
    }

    public function isFull()
    {
        return $this->remainingSeats() <= 0;
    }
}
