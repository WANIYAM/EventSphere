<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    // Event Participants Report
    public function eventParticipants($eventId)
    {
        $event = Event::with('registrations.user')->findOrFail($eventId);
        $pdf = PDF::loadView('admin.reports.event_participants', compact('event'));
        return $pdf->download('event_participants_'.$event->id.'.pdf');
    }

    // Feedback Report
    public function feedbacks()
    {
        $feedbacks = Feedback::with('user', 'event')->get();
        $pdf = PDF::loadView('admin.reports.feedbacks', compact('feedbacks'));
        return $pdf->download('feedbacks.pdf');
    }

    // User Growth Report
    public function userGrowth(Request $request)
    {
        // Example: users registered in last 30 days
        $users = User::where('created_at', '>=', now()->subDays(30))->get();
        $pdf = PDF::loadView('admin.reports.user_growth', compact('users'));
        return $pdf->download('user_growth.pdf');
    }
}
