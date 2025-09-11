<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function create($eventId)
    {
        $event = Event::findOrFail($eventId);
        return view('student.feedback.create', compact('event'));
    }

    public function store(Request $request, $eventId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:1000',
        ]);

        Feedback::create([
            'event_id'   => $eventId,
            'student_id' => Auth::id(),
            'rating'     => $request->rating,
            'comments'   => $request->comments,
        ]);

        return redirect()->route('student.my-registrations')->with('success', 'Thank you for your feedback!');
    }
    public function peerReviews($eventId)
{
    $event = Event::findOrFail($eventId);

    // Only allow past events
    if ($event->date >= now()) {
        return back()->with('error', 'Peer reviews are available only for past events.');
    }

    // Fetch all feedback except the current student
    $feedbacks = $event->feedback()->where('student_id', '!=', auth()->id())->with('student')->get();

    return view('student.feedback.peer', compact('event', 'feedbacks'));
}

}
