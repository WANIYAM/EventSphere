<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Event;

class FeedbackController extends Controller
{
    public function index()
    {
        // Detailed feedback list
        $feedbacks = Feedback::with(['event', 'student'])->latest()->paginate(10);

        // Average rating per event
        $eventRatings = Feedback::selectRaw('event_id, AVG(rating) as avg_rating, COUNT(*) as total_feedbacks')
            ->groupBy('event_id')
            ->with('event')
            ->get();

        return view('admin.feedback.index', compact('feedbacks', 'eventRatings'));
    }
}
