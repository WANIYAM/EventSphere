<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class EventPromotionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['database']; // stored in DB for dashboard
    }

    public function toDatabase($notifiable)
    {
        return [
            'event_id' => $this->event->id,
            'title'    => $this->event->title,
            'message'  => "Good news! You’ve been moved from the waitlist to confirmed for the event '{$this->event->title}'.",
        ];
    }
}
